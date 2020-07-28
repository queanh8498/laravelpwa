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
	//khohang
	Route::get('/danhsach-kho','KhohangController@getdanhsach_kho');
	Route::get('/tao-kho','KhohangController@gettao_kho');
	Route::post('/tao-kho','KhohangController@posttao_kho');
	Route::get('/sua-kho/{kho_id}','KhohangController@getsua_kho');
	Route::post('/sua-kho/{kho_id}','KhohangController@postsua_kho');
	//nhacungcap
	Route::get('/danhsach-ncc','NhacungcapController@getdanhsach_ncc');
	Route::get('/tao-ncc','NhacungcapController@gettao_ncc');
	Route::post('/tao-ncc','NhacungcapController@posttao_ncc');
	Route::get('/sua-ncc/{ncc_id}','NhacungcapController@getsua_ncc');
	Route::post('/sua-ncc/{ncc_id}','NhacungcapController@postsua_ncc');
	//nhomhanghoa
	Route::get('/danhsach-nhom','NhomhanghoaController@getdanhsach_nhom');
	Route::get('/nhomhanghoa/{ncc_id}','NhomhanghoaController@nhomhanghoa');
	Route::get('/tao-nhom','NhomhanghoaController@gettao_nhom');
	Route::post('/tao-nhom','NhomhanghoaController@posttao_nhom');
	Route::get('/sua-nhom/{nhom_id}','NhomhanghoaController@getsua_nhom');
	Route::post('/sua-nhom/{nhom_id}','NhomhanghoaController@postsua_nhom');

	//hanghoa
	Route::get('/danhsach-hh','HanghoaController@getdanhsach_hh');
	Route::get('/tao-hh','HanghoaController@gettao_hh');
	Route::post('/tao-hh','HanghoaController@posttao_hh');
	Route::get('/sua-hh/{hh_id}','HanghoaController@getsua_hh');
	Route::post('/sua-hh/{hh_id}','HanghoaController@postsua_hh');
	Route::get('/nhh-hh-theoncc','HanghoaController@nhh_hh_theoncc');
	//phieunhapkho
	Route::get('/danhsach-pnk','PhieunhapkhoController@getdanhsach_pnk');
	Route::get('/chitiet-pnk/{pnk_id}','PhieunhapkhoController@getchitiet_pnk');
	Route::get('/tao-pnk','PhieunhapkhoController@gettao_pnk');
	Route::get('/dongia','PhieunhapkhoController@dongia');
	Route::get('/hanghoa','PhieunhapkhoController@hanghoa');
	Route::get('/nhh-theoncc','PhieunhapkhoController@nhh_theoncc');
Route::post('/dynamic-field/insert', 'PhieunhapkhoController@insert')->name('dynamic-field.insert');
//phieutrahang
	Route::get('/danhsach-pth','PhieutrahangController@getdanhsach_pth');
	Route::get('/chitiet-pth/{pth_id}','PhieutrahangController@getchitiet_pth');
	Route::get('/tao-pth','PhieutrahangController@gettao_pth');
	Route::get('/ddh/{kh_id}','PhieutrahangController@ddh');
	Route::get('/checkddh','PhieutrahangController@checkddh');
	Route::post('/dynamic-field/insertddh', 'PhieutrahangController@insertddh')->name('dynamic-field.insertddh');
//phieutrancc
	
	Route::get('/tao-ptncc/{pnk_id}','PhieutranhacungcapController@gettao_ptncc');
	Route::post('/dynamic-field/insertncc', 'PhieutranhacungcapController@insertncc')->name('dynamic-field.insertncc');
	Route::get('/danhsach-ptncc','PhieutranhacungcapController@getdanhsach_ptncc');
	Route::get('/chitiet-ptncc/{ptncc_id}','PhieutranhacungcapController@getchitiet_ptncc');
	

	//khachhang
	Route::get('/khachhang','KhachhangController@index')->name('khachhang.index');
	Route::get('/khachhang','KhachhangController@create')->name('khachhang.create');
	Route::get('/khachhang/edit/{id}','KhachhangController@edit')->name('khachhang.edit');
	Route::post('/khachhang/update/{id}','KhachhangController@update')->name('khachhang.update');
	Route::get('/khachhang/chitiet/{id}','KhachhangController@getdetail');
	Route::resource('/khachhang', 'KhachhangController');

	//dondathang
	Route::get('/danhsachdondathang','DonDatHangController@xem_danhsachdondathang');
	Route::get('/chitietdondathang/{ddh_id}','DonDatHangController@chitietdondathang');
	
//QUẢN LÝ BÁN HÀNG
	
	});
//KẾ TOÁN CÔNG NỢ
Route::group(['prefix'=>'ketoan','middleware'=>'Nhanvien_Login'],function(){
	Route::get('/tongquanketoan','NhanvienController@xem_tongquanketoan');
//QUẢN LÝ KHO HÀNG

	
//QUẢN LÝ CÔNG NỢ
	});