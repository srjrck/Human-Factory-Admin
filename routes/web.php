<?php
/*Admin Panel*/
Route::get('/Admin', ['as' => 'Login', 'uses' => 'Admin\LoginController@Login']);
Route::post('/Admin/AdminLoginValidate', ['as' => 'AdminLoginValidate', 'uses' => 'Admin\LoginController@AdminLoginValidate']);
Route::get('/Admin/reset-password', ['as' => 'ResetPassword', 'uses' => 'Admin\LoginController@ResetPassword']);
Route::post('/Admin/CheckResetPassword', ['as' => 'CheckResetPassword', 'uses' => 'Admin\LoginController@CheckResetPassword']);

Route::group(['namespace' => 'Admin', 'prefix' => 'Admin', 'middleware'=>['IsAdminLogin']], function () {
	Route::get('/dashboard', ['as' => 'Dashboard', 'uses' => 'DashboardController@Dashboard']);
	Route::get('/Logout', ['as' => 'Logout', 'uses' => 'LoginController@Logout']);

	/*Setting*/	
	Route::get('/setting',['as'=>'Setting','uses'=>'SettingController@Setting']);
	Route::post('/UpdateProfile',['as'=>'UpdateProfile','uses'=>'SettingController@UpdateProfile']);
	Route::post('/ChangePassword',['as'=>'ChangePassword','uses'=>'SettingController@ChangePassword']);
	Route::post('/UpdateSocialMedia',['as'=>'UpdateSocialMedia','uses'=>'SettingController@UpdateSocialMedia']);
	Route::post('/UpdatePagination',['as'=>'UpdatePagination','uses'=>'SettingController@UpdatePagination']);
	/*Setting*/	

	/*Identifier*/
	Route::get('/identifier',['as'=>'Identifier','uses'=>'IdentifierController@Identifier']);
	Route::get('/add-identifier',['as'=>'AddIdentifier','uses'=>'IdentifierController@Add']);
	Route::post('/InsertIdentifier',['as'=>'InsertIdentifier','uses'=>'IdentifierController@Save']);
	Route::post('/SaveIdentifier',['as'=>'SaveIdentifier','uses'=>'IdentifierController@SaveData']);
	Route::get('/edit-identifier/{ID}',['as'=>'EditIdentifier','uses'=>'IdentifierController@Edit']);
	Route::get('/DeleteIdentifier/{ID}',['as'=>'DeleteIdentifier','uses'=>'IdentifierController@Delete']);

	/*Name*/
	Route::get('/name',['as'=>'Name','uses'=>'NameController@List']);
	Route::get('/add-name',['as'=>'AddName','uses'=>'NameController@Add']);
	Route::post('/InsertName',['as'=>'InsertName','uses'=>'NameController@Save']);
	Route::post('/SaveName',['as'=>'SaveName','uses'=>'NameController@SaveData']);
	Route::get('/edit-name/{ID}',['as'=>'EditName','uses'=>'NameController@Edit']);
	Route::get('/DeleteName/{ID}',['as'=>'DeleteName','uses'=>'NameController@Delete']);

	/*Telecom*/
	Route::get('/telecom',['as'=>'Telecom','uses'=>'TelecomController@List']);
	Route::get('/add-telecom',['as'=>'AddTelecom','uses'=>'TelecomController@Add']);
	Route::post('/InsertTelecom',['as'=>'InsertTelecom','uses'=>'TelecomController@Save']);
	Route::post('/SaveTelecom',['as'=>'SaveTelecom','uses'=>'TelecomController@SaveData']);
	Route::get('/edit-telecom/{ID}',['as'=>'EditTelecom','uses'=>'TelecomController@Edit']);
	Route::get('/DeleteTelecom/{ID}',['as'=>'DeleteTelecom','uses'=>'TelecomController@Delete']);


});