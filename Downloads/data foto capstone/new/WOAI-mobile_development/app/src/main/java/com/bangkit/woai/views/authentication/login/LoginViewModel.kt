package com.bangkit.woai.views.authentication.login

import android.util.Log
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.bangkit.woai.data.UserRepository
import com.bangkit.woai.data.response.LoginResponse
import kotlinx.coroutines.flow.collect
import kotlinx.coroutines.launch
import org.json.JSONObject
import retrofit2.HttpException

class LoginViewModel(private val repository: UserRepository) : ViewModel() {
    val loginStatus: MutableLiveData<Result<LoginResponse>> = MutableLiveData()

    fun login(email: String, password: String) {
        viewModelScope.launch {
            try {
                val response = repository.loginUser(email, password)
                if (response.message.isNullOrEmpty()) {
                    val token = response.token
                    if (!token.isNullOrEmpty()) {
                        repository.saveSession(email, token, true)
                        repository.getSession().collect() { userModel ->
                            repository.saveSession(email, token, true)
                            Log.d("LoginActivity", "Token: $token")
                            Log.d("LoginActivity", "Email: ${userModel.email}")
                            Log.d("LoginActivity", "IsLogin: ${userModel.isLogin}")
                            loginStatus.postValue(Result.success(response)
                            )
                            Log.d("LoginActivity", "Token: $token")
                        }
                    } else {
                        loginStatus.postValue(Result.failure(Exception("Token tidak ditemukan dalam respons login!")))
                    }
                } else {
                    loginStatus.postValue(
                        Result.failure(
                            Exception(
                                response.message ?: "Terjadi kesalahan saat login!"
                            )
                        )
                    )
                }
            } catch (e: HttpException) {
                val errorBodyString = e.response()?.errorBody()?.string()
                try {
                    val jsonObject = JSONObject(errorBodyString)
                    val extractedMessage = jsonObject.getString("message")
                    loginStatus.postValue(Result.failure(Exception(extractedMessage)))
                } catch (ex: Exception) {
                    loginStatus.postValue(Result.failure(Exception("Terjadi kesalahan saat login!")))
                }
            } catch (e: Exception) {
                loginStatus.postValue(Result.failure(e))
            }
        }
    }
}
