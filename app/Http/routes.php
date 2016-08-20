<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

// get notification of tuition news
Route::get('/notification/tuition', 'UetNews@getTuitionNotification');

// get notification of point news
Route::get('/notification/point', 'UetNews@point');

// get notification of schedule news
Route::get('/notification/schedule', 'UetNews@getScheduleNotification');

// send notification to client
Route::get('notification', 'PushNotificationController@sendNotificationToDevice');

// get list tuition news
Route::get('/tuition/news', 'UetNews@tuitionNews');

//get list schedule news
Route::get('/schedule/news', 'UetNews@scheduleNews');

// get list subject available of semester with lstClass = id
Route::get('/semester/{id}', 'UetNews@getAvailableSubject');

// register subject to get notification
Route::post('/subject', 'UetNews@registerSubject');

// register semester to get notification of subject respectively
Route::post('/semester', 'UetNews@registerSemester');

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    //Account
    $api->post('signin', 'App\Http\Controllers\Auth\AuthController@signin');
    $api->post('registerSemester', 'App\Http\Controllers\UetNews@registerSemester');
    $api->post('registerSubject', 'App\Http\Controllers\UetNews@registerSubject');
});
//Ly Tuan Route 
//Social route

Route::get('facebook/redirect', 'Auth\SocialController@redirectToProvider');
Route::get('facebook/callback', 'Auth\SocialController@handleProviderCallback');
Route::get('google/redirect', 'Auth\SocialController@redirectToProviderGoogle');
Route::get('google/callback', 'Auth\SocialController@handleProviderCallbackGoogle');
//Route send mail welcome
Route::get('/email',function(){
	$data=News::where('status','2');
	Mail::send('emails.welcome', ['data_news'=>$data], function ($message) {
    $message->from('supporteruet@gmail.com', 'UET-SUPPORTER');

    $message->to('lytuanwork@gmail.com')->subject('Introduction');
});
});
//Route login, logout, signup, reset password
Route::auth();

Route::get('/home', 'HomeController@index');
//Route API Login, signup
Route::resource('LoginAPI','API\LoginAPIController');
//Route for admin page

Route::group(['middleware' => 'auth'], function () {

	Route::group(['prefix'=>'uet_admin'], function(){
		Route::get('/','HomeController@index');
		Route::group(['prefix'=>'user'], function(){
			Route::get('list',['as'=>'getListUser','middleware' => 'auth', 'uses'=>'Admin\UserController@getListUser']);
			Route::get('add',['as'=>'getAddUser', 'uses'=>'Admin\UserController@getAddUser']);
			Route::get('delete/{id}',['as'=>'getUserDel', 'uses'=>'Admin\UserController@getUserDel']);
		});
		Route::group(['prefix'=>'category'], function(){
			Route::get('list',['as'=>'getListUser','middleware' => 'auth', 'uses'=>'Admin\UserController@getListUser']);
			Route::get('add',['as'=>'getAddUser', 'uses'=>'Admin\UserController@getAddUser']);
		});
		Route::group(['prefix'=>'news'], function(){
			Route::get('list',['as'=>'getListUser','middleware' => 'auth', 'uses'=>'Admin\UserController@getListUser']);
			Route::get('add',['as'=>'getAddUser', 'uses'=>'Admin\UserController@getAddUser']);
		});
	});

});