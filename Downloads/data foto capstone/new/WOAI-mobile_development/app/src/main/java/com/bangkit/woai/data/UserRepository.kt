package com.bangkit.woai.data

import com.bangkit.woai.data.pref.UserModel
import com.bangkit.woai.data.pref.UserPreference
import com.bangkit.woai.data.request.LoginRequest
import com.bangkit.woai.data.request.RegisterRequest
import com.bangkit.woai.data.response.LoginResponse
import com.bangkit.woai.data.response.RegisterResponse
import com.bangkit.woai.data.retrofit.ApiService
import kotlinx.coroutines.flow.Flow

class UserRepository private constructor(
    private val apiService: ApiService,
    private val userPreference: UserPreference
) {

    suspend fun registerUser(name: String, email: String, height: Int, weight: Int, password_hash: String): RegisterResponse {
        return apiService.register(
            RegisterRequest(name, email, height, weight, password_hash)
        )
    }

    suspend fun loginUser(email: String, password_hash: String): LoginResponse {
        return apiService.login(
            LoginRequest(email, password_hash)
        )
    }

    suspend fun saveSession(email: String, token: String, isLogin: Boolean) {
        userPreference.saveSession(UserModel(email, token, isLogin))
    }

    fun getSession(): Flow<UserModel> {
        return userPreference.getSession()
    }

    suspend fun logout() {
        userPreference.logout()
    }

    suspend fun saveAuthToken(token: String) {
        userPreference.saveAuthToken(token)
    }

    companion object {
        @Volatile
        private var instance: UserRepository? = null
        fun getInstance(
            apiService: ApiService,
            userPreference: UserPreference
        ): UserRepository =
            instance ?: synchronized(this) {
                instance ?: UserRepository(apiService, userPreference)
            }.also { instance = it }
    }
}
