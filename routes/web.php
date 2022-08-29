<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// ユーザー登録

Route::group(['middleware' => ['admin']], function(){
    Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
    Route::post('signup','Auth\RegisterController@register')->name('signup.post');
});

// 認証
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

// ユーザー一覧、詳細
Route::group(['middleware' => ['auth']], function(){
    Route::resource('users', 'UsersController',['only' => ['index']]);
});

// 医院情報の詳細
Route::group(['middleware'=>['auth']], function(){
    // url上に認証しているユーザの情報のみで扱う{id}は不要
    Route::group(['prefix' => 'clinic'], function () {
        // 診療時間の表示・追加・削除
        Route::get('show','ConsultationHoursController@show')->name('clinic.show');
        Route::get('edit','ConsultationHoursController@edit')->name('clinic.edit');
        Route::post('opened','ConsultationHoursController@store')->name('clinic.opened');
        Route::delete('closed','ConsultationHoursController@destroy')->name('clinic.closed');
        Route::get('reserve','ReservationController@show')->name('reserve.show');
        Route::post('reserve/patients','ReservationController@dateStore')->name('reserve.dateStore');
        Route::get('reserve/patients/form','ReservationController@edit')->name('reserve.edit');
        Route::post('reserve/patients/store','ReservationController@store')->name('reserve.store');
    });
});

// ゲスト表示
Route::group(['prefix' => 'reserve/{id}'],function(){
    Route::get('/','GuestReservationController@index')->name('guest.index');
    Route::get('show','GuestReservationController@show')->name('guest.show');
    Route::post('dateStore','GuestReservationController@dateStore')->name('guest.dateStore');
    Route::get('edit','GuestReservationController@edit')->name('guest.edit');
    Route::post('store','GuestReservationController@store')->name('guest.store');
    Route::get('thanks','GuestReservationController@thanks')->name('guest.thanks');
});





//　管理会社ページ（管理者権限）医院一覧
Route::group(['middleware'=>['auth']], function(){
    Route::group(['prefix' => 'users'], function () {
        // ユーザー一覧ページ
        Route::get('/','UsersController@index')->name('users.index');
    });
});


// /Auth::user()はviewでそのまま使う
// view上でセッションのデータは