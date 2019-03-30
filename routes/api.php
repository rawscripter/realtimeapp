<?php

Route::apiResource('/question','QuestionController');

Route::apiResource('/category','CategoryController');

Route::apiResource('/question/{question}/reply','ReplyController');
Route::post('/{reply}/like','LikeController@like');
Route::delete('/{reply}/like','LikeController@disLike');

