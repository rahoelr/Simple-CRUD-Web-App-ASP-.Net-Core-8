package com.bangkit.woai.data

import com.bangkit.woai.R

object DummyData {
    val workoutTrainings = listOf(
        WorkoutTraining("1 Minute Push-Up", R.drawable.get_started),
        WorkoutTraining("2 Minute Push-Up", R.drawable.get_started_2),
        WorkoutTraining("3 Minute Push-Up", R.drawable.get_started_3),
        WorkoutTraining("Custom Push-Up", R.drawable.get_started),
    )

    val historyTrainings = listOf(
        HistoryTraining("No Data", "-- : --"),
    )
}