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

//Route::get('/', function () {
//    return view('user.home');
//})->name('user.home');
Route::get('/', 'UserController@getHome')->name('user.home');
Route::get('/tai-lieu-theo-mon', 'UserController@getTaiLieuTheoMon')->name('user.taiLieuTheoMon');
Route::get('/chi-tiet', 'UserController@getChiTietTaiLieu')->name('user.chiTietTaiLieu');
Route::get('/tim-kiem', 'UserController@getTimKiemTaiLieu')->name('user.timKiemTaiLieu');

Auth::routes();

Route::group(['prefix' => 'admin','middleware' => ['isAdmin']], function(){
    Route::get('/', 'AdminController@getHome')->name('admin.home');
    Route::get('/chuong-trinh-dao-tao', 'AdminController@getChuongTrinhDaoTao')->name('admin.chuongTrinhDaoTao');
    Route::get('/mon-hoc', 'AdminController@getMonHoc')->name('admin.monHoc');
    Route::get('/tai-lieu', 'AdminController@getTaiLieu')->name('admin.taiLieu');
    Route::post('/them-chuong-trinh-dao-tao', 'AdminController@themChuongTrinhDaoTao');
    Route::post('/them-mon-hoc', 'AdminController@themMonHoc');
    Route::post('/them-tai-lieu', 'AdminController@themTaiLieu');
    Route::post('/delete-mon-hoc', 'AdminController@xoaMonHoc');
    Route::post('/delete-tai-lieu', 'AdminController@xoaTaiLieu');
    Route::post('/sua-chuong-trinh-dao-tao', 'AdminController@suaChuongTrinhDaoTao');
    Route::post('/sua-mon-hoc', 'AdminController@suaMonHoc');
    Route::post('/lay-danh-sach-chuong-trinh-dao-tao', 'AdminController@layDanhSachChuongTrinhDaoTao');
    Route::post('/lay-danh-sach-mon-hoc', 'AdminController@layDanhSachMonHoc');
    Route::post('/lay-danh-sach-tai-lieu', 'AdminController@layDanhSachTaiLieu');
});
