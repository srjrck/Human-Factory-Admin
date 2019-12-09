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

	/*Practitioner*/
	Route::get('/practitioner',['as'=>'Practitioner','uses'=>'PractitionerController@Practitioner']);
	Route::get('/add-practitioner',['as'=>'AddPractitioner','uses'=>'PractitionerController@AddPractitioner']);
	Route::post('/InsertPractitioner',['as'=>'InsertPractitioner','uses'=>'PractitionerController@InsertPractitioner']);
	Route::get('/CheckPractitioner/{ID}',['as'=>'CheckPractitioner','uses'=>'PractitionerController@CheckPractitioner']);
	Route::get('/DeletePractitioner/{ID}',['as'=>'DeletePractitioner','uses'=>'PractitionerController@DeletePractitioner']);
	Route::get('/view-practitioner/{ID}',['as'=>'ViewPractitioner','uses'=>'PractitionerController@ViewPractitioner']);
	
	/*CareTeam*/
	Route::get('/care-team',['as'=>'CareTeam','uses'=>'PractitionerController@CareTeam']);
	Route::get('/add-care-team',['as'=>'AddCareTeam','uses'=>'PractitionerController@AddCareTeam']);
	Route::post('/InsertCareTeam',['as'=>'InsertCareTeam','uses'=>'PractitionerController@InsertCareTeam']);
	Route::get('/view-care-team/{ID}',['as'=>'ViewCareTeam','uses'=>'PractitionerController@ViewCareTeam']);
	Route::get('/DeleteCareTeam/{ID}',['as'=>'DeleteCareTeam','uses'=>'PractitionerController@DeleteCareTeam']);
	Route::get('/assign-care-team/{ID}',['as'=>'AssignCareTeam','uses'=>'PractitionerController@AssignCareTeam']);
	Route::post('/InsertAssign',['as'=>'InsertAssign','uses'=>'PractitionerController@InsertAssign']);
	
	/*Role*/
	Route::get('/role',['as'=>'Role','uses'=>'RoleController@List']);
	Route::get('/add-Role',['as'=>'AddRole','uses'=>'RoleController@Add']);
	Route::post('/InsertRole',['as'=>'InsertRole','uses'=>'RoleController@Save']);

});