package com.bangkit.woai.views.main

import android.content.Intent
import android.os.Bundle
import android.util.Log
import android.widget.Toast
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.lifecycle.lifecycleScope
import androidx.recyclerview.widget.LinearLayoutManager
import com.bangkit.woai.data.DummyData
import com.bangkit.woai.data.WorkoutTraining
import com.bangkit.woai.data.pref.UserPreference
import com.bangkit.woai.data.pref.dataStore
import com.bangkit.woai.databinding.ActivityMainBinding
import com.bangkit.woai.views.ViewModelFactory
import com.bangkit.woai.views.authentication.login.LoginViewModel
import com.bangkit.woai.views.authentication.login.LoginViewModelFactory
import com.bangkit.woai.views.authentication.register.RegisterViewModel
import com.bangkit.woai.views.history.HistoryActivity
import com.bangkit.woai.views.profile.ProfileActivity
import com.bangkit.woai.views.strated.GetStartedAct

class MainActivity : AppCompatActivity() {
    private lateinit var binding: ActivityMainBinding
    private val viewModel by viewModels<MainViewModel> {
        ViewModelFactory.getInstance(this)
    }


    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityMainBinding.inflate(layoutInflater)
        setContentView(binding.root)

        val adapterMain = WorkoutTrainingAdapter(DummyData.workoutTrainings, object : WorkoutTrainingAdapter.OnItemClickListener {
            override fun onItemClick(workoutTraining: WorkoutTraining) {
                showToast(workoutTraining.title)
            }
        })
        binding.rvMain.adapter = adapterMain
        binding.rvMain.layoutManager =
            LinearLayoutManager(this, LinearLayoutManager.HORIZONTAL, false)

        val adapterHistory = HistoryTrainingAdapter(DummyData.historyTrainings, true)
        binding.rvHistory.adapter = adapterHistory
        binding.rvHistory.layoutManager = LinearLayoutManager(this, LinearLayoutManager.VERTICAL, false)

        binding.txtViewMore.setOnClickListener {
            val historyAct = Intent(this, HistoryActivity::class.java)
            startActivity(historyAct)
        }

        binding.profileImage.setOnClickListener{
            val profileAct = Intent(this, ProfileActivity::class.java)
            startActivity(profileAct)
        }

        viewModel.getSession().observe(this) { user ->
            if (user.isLogin == false) {
                startActivity(Intent(this, GetStartedAct::class.java))
                finish()
            }
        }


    }

    private fun showToast(message: String) {
        Toast.makeText(this, "Clicked: $message", Toast.LENGTH_SHORT).show()
    }

}

