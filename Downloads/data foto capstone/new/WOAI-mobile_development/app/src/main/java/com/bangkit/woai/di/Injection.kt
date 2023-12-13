package com.bangkit.woai.di

import android.content.Context
import com.bangkit.woai.data.UserRepository
import com.bangkit.woai.data.pref.UserPreference
import com.bangkit.woai.data.pref.dataStore
import com.bangkit.woai.data.retrofit.ApiConfig
import com.bangkit.woai.data.retrofit.ApiService

object Injection {

    fun provideUserRepository(context: Context): UserRepository {
        val apiService = ApiConfig().getApiService(context)
        val userPreference = UserPreference.getInstance(context.dataStore)
        return UserRepository.getInstance(apiService, userPreference)
    }

//    fun provideApiService(context: Context): ApiService {
//        return ApiConfig().getApiService()
//    }
}