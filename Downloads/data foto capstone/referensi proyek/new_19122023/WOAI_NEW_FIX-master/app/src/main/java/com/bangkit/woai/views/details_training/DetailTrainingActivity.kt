package com.bangkit.woai.views.details_training

import android.content.Intent
import android.content.pm.PackageManager
import android.os.Build
import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import android.view.WindowInsets
import android.view.WindowManager
import android.widget.Toast
import androidx.activity.result.contract.ActivityResultContracts
import androidx.core.content.ContextCompat
import com.bangkit.woai.R
import com.bangkit.woai.databinding.ActivityDetailTrainingBinding
import com.bangkit.woai.views.camera.CameraActivity
import com.bangkit.woai.views.camera.NewCameraActivity

class DetailTrainingActivity : AppCompatActivity() {
    private lateinit var binding: ActivityDetailTrainingBinding

    private val requestPermissionLauncher =
        registerForActivityResult(
            ActivityResultContracts.RequestPermission()
        ) { isGranted: Boolean ->
            if (isGranted) {
                Toast.makeText(this, "Permission request granted", Toast.LENGTH_LONG).show()
            } else {
                Toast.makeText(this, "Permission request denied", Toast.LENGTH_LONG).show()
            }
        }

    private fun allPermissionsGranted() =
        ContextCompat.checkSelfPermission(
            this,
            REQUIRED_PERMISSION
        ) == PackageManager.PERMISSION_GRANTED

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailTrainingBinding.inflate(layoutInflater)
        setContentView(binding.root)


        val radius = 5f
        binding.blurView.setupWith(binding.container)
            .setBlurRadius(radius)

        binding.btnStart.setOnClickListener {
            if (!allPermissionsGranted()) {
                requestPermissionLauncher.launch(REQUIRED_PERMISSION)
            } else {
//                openCamera()
                openNewCamera()
            }
        }

        binding.btnBack.setOnClickListener {
            finish()
        }

        hideSystemUI()

    }

    private fun openCamera() {
        val intentCameraX = Intent(this, CameraActivity::class.java)
        startActivity(intentCameraX)
    }

    private fun openNewCamera() {
        val intentCameraX = Intent(this, NewCameraActivity::class.java)
        startActivity(intentCameraX)
    }

    private fun hideSystemUI() {
        @Suppress("DEPRECATION")
        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.R) {
            window.insetsController?.hide(WindowInsets.Type.statusBars())
        } else {
            window.setFlags(
                WindowManager.LayoutParams.FLAG_FULLSCREEN,
                WindowManager.LayoutParams.FLAG_FULLSCREEN
            )
        }
        supportActionBar?.hide()
    }

    companion object {
        private const val REQUIRED_PERMISSION = android.Manifest.permission.CAMERA
    }
}