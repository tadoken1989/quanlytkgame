<?php

Route::auth();


Route::group(['namespace' => 'FrontEnd', 'prefix' => ''], function () {
    Route::get('/', ['as' => 'frontend.user.login', 'uses' => 'AuthController@login']);
    Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@login']);
    Route::post('/user/login', ['as' => 'frontend.user.submitLogin', 'uses' => 'AuthController@checkLogin']);
    Route::get('/user/login', ['as' => 'frontend.user.login_2', 'uses' => 'AuthController@login']);
    Route::get('/user/logout', ['as' => 'frontend.user.logout', 'uses' => 'UserController@logout']);
    Route::get('/user/profile', ['as' => 'frontend.user.profile', 'uses' => 'UserController@profile']);
    Route::get('/user/register', ['as' => 'frontend.user.register', 'uses' => 'AuthController@register']);
    Route::post('/user/register', ['as' => 'frontend.user.register.submit', 'uses' => 'AuthController@registerAction']);
    Route::get('/user/password/forgot', ['as' => 'frontend.user.forgot', 'uses' => 'AuthController@forgot']);

    Route::get('/user/password/change-password', ['as' => 'frontend.user.change-pass', 'uses' => 'UserController@changePassword']);
    Route::get('/user/password/change-password-2', ['as' => 'frontend.user.change-pass-2', 'uses' => 'UserController@changePassword2']);
    Route::get('/user/password/change-email', ['as' => 'frontend.user.change-email', 'uses' => 'UserController@changeEmail']);

    Route::get('/feedback/send', ['as' => 'frontend.feedback.form-feedback', 'uses' => 'FeedbackController@send']);

    Route::get('/user/payment', ['as' => 'frontend.user.payment', 'uses' => 'UserController@payment']);
    Route::get('/user/payment/atm', ['as' => 'frontend.user.payment_atm', 'uses' => 'UserController@paymentAtm']);

    Route::get('/user/baking/', ['as' => 'frontend.user.baking', 'uses' => 'UserController@bakingResult']);

    Route::post('/user/password/change-password', ['as' => 'frontend.user.change-pass.submit', 'uses' => 'UserController@changePasswordAction']);
    Route::post('/user/password/change-password-2', ['as' => 'frontend.user.change-pass-2.submit', 'uses' => 'UserController@changePassword2Action']);
    Route::post('/user/password/change-email', ['as' => 'frontend.user.change-email.submit', 'uses' => 'UserController@changeEmailAction']);

    Route::post('/user/forgot/check-phone', ['as' => 'frontend.user.check-phone', 'uses' => 'AjaxController@sendCodeForgot']);
    Route::post('/user/get-new-pass', ['as' => 'frontend.user.get_new_pass', 'uses' => 'AuthController@getNewPass']);

    Route::post('/user/payment', ['as' => 'user.payment.card', 'uses' => 'UserController@paymentAction']);
    Route::post('/user/payment/atm', ['as' => 'user.payment.atm', 'uses' => 'UserController@paymentAtmAction']);

    Route::post('/feedback/send', ['as' => 'frontend.feedback.submit', 'uses' => 'FeedbackController@sendAction']);



    Route::get('/user/payment/history', ['as' => 'user.payment.history', 'uses' => 'UserController@userPaymentHistory']);

});
