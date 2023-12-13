package com.bangkit.woai.data.retrofit

import com.bangkit.woai.data.request.LoginRequest
import com.bangkit.woai.data.request.RegisterRequest
import com.bangkit.woai.data.response.LoginResponse
import com.bangkit.woai.data.response.RegisterResponse
import retrofit2.http.Body
import retrofit2.http.Field
import retrofit2.http.FormUrlEncoded
import retrofit2.http.POST

interface ApiService {

    @POST("register")
   suspend fun register(
        @Body request: RegisterRequest
    ) : RegisterResponse

    @POST("login")
    suspend fun login(
        @Body request: LoginRequest
    ) : LoginResponse

}