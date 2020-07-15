<?php

use Illuminate\Support\Facades\Route;

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
//BACKEND
//ĐĂNG NHẬP
Route::get('/dangnhap','NhanvienController@getdangnhap');
Route::post('/dangnhap','NhanvienController@postdangnhap');
//ĐĂNG XUẤT
Route::get('/dangxuat','NhanvienController@getdangxuat');
//NHÂN VIÊN BÁN HÀNG
Route::group(['prefix'=>'banhang','middleware'=>'Nhanvien_Login'],function(){
	Route::get('/tongquanbanhang','NhanvienController@xem_tongquanbanhang');
//QUẢN LÝ KHO HÀNG


//QUẢN LÝ BÁN HÀNG
	
	});
//KẾ TOÁN CÔNG NỢ
Route::group(['prefix'=>'ketoan','middleware'=>'Nhanvien_Login'],function(){
	Route::get('/tongquanketoan','NhanvienController@xem_tongquanketoan');
//QUẢN LÝ KHO HÀNG

	
//QUẢN LÝ CÔNG NỢ
	});