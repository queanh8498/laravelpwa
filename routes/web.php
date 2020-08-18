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
	Route::get('xoa-kho/{kho_id}','KhohangController@getxoa_kho');
	//nhanvien
	Route::get('/danhsach-nv','NhanvienController@getdanhsach_nv');
	Route::get('/tao-nv','NhanvienController@gettao_nv');
	Route::post('/tao-nv','NhanvienController@posttao_nv');
	Route::get('/sua-nv/{nv_id}','NhanvienController@getsua_nv');
	Route::post('/sua-nv/{nv_id}','NhanvienController@postsua_nv');
	Route::get('/xoa-nv/{nv_id}','NhanvienController@getxoa_nv');
	//nhacungcap
	Route::get('/danhsach-ncc','NhacungcapController@getdanhsach_ncc');
	Route::get('/tao-ncc','NhacungcapController@gettao_ncc');
	Route::post('/tao-ncc','NhacungcapController@posttao_ncc');
	Route::get('/sua-ncc/{ncc_id}','NhacungcapController@getsua_ncc');
	Route::post('/sua-ncc/{ncc_id}','NhacungcapController@postsua_ncc');
	Route::get('xoa-ncc/{ncc_id}','NhacungcapController@getxoa_ncc');
	//nhomhanghoa
	Route::get('/danhsach-nhom','NhomhanghoaController@getdanhsach_nhom');
	Route::get('/nhomhanghoa/{ncc_id}','NhomhanghoaController@nhomhanghoa');
	Route::get('/tao-nhom','NhomhanghoaController@gettao_nhom');
	Route::post('/tao-nhom','NhomhanghoaController@posttao_nhom');
	Route::get('/sua-nhom/{nhom_id}','NhomhanghoaController@getsua_nhom');
	Route::post('/sua-nhom/{nhom_id}','NhomhanghoaController@postsua_nhom');
	Route::get('xoa-nhom/{nhom_id}','NhomhanghoaController@getxoa_nhom');

	//hanghoa
	Route::get('/danhsach-hh','HanghoaController@getdanhsach_hh');
	Route::get('/tao-hh','HanghoaController@gettao_hh');
	Route::post('/tao-hh','HanghoaController@posttao_hh');
	Route::get('/sua-hh/{hh_id}','HanghoaController@getsua_hh');
	Route::post('/sua-hh/{hh_id}','HanghoaController@postsua_hh');
	Route::get('/nhh-hh-theoncc','HanghoaController@nhh_hh_theoncc');
	Route::get('xoa-hh/{hh_id}','HanghoaController@getxoa_hh');
	 Route::get('/ton-hh','HanghoaController@getton_hh');
    Route::get('/tinhtrang/{tinhtrang}','HanghoaController@gettinhtrang');
	//phieunhapkho
	Route::get('/danhsach-pnk','PhieunhapkhoController@getdanhsach_pnk');
	Route::get('/chitiet-pnk/{pnk_id}','PhieunhapkhoController@getchitiet_pnk');
	Route::get('/tao-pnk','PhieunhapkhoController@gettao_pnk');
	Route::get('/dongia','PhieunhapkhoController@dongia');
	Route::get('/hanghoa','PhieunhapkhoController@hanghoa');
	Route::get('/nhh-theoncc','PhieunhapkhoController@nhh_theoncc');
	Route::get('/pdf-pnk/{pnk_id}', 'PhieunhapkhoController@pdf_pnk');
	Route::get('/excel-pnk/{pnk_id}', 'PhieunhapkhoController@excel_pnk');
    Route::post('/dynamic-field/insert', 'PhieunhapkhoController@insert')->name('dynamic-field.insert');

//phieutrahang
	Route::get('/danhsach-pth','PhieutrahangController@getdanhsach_pth');
	Route::get('/chitiet-pth/{pth_id}','PhieutrahangController@getchitiet_pth');
	Route::get('/tao-pth','PhieutrahangController@gettao_pth');
	Route::get('/ddh/{kh_id}','PhieutrahangController@ddh');
	Route::get('/checkddh','PhieutrahangController@checkddh');
	Route::get('/pdf-pth/{pth_id}', 'PhieutrahangController@pdf_pth');
	Route::get('/excel-pth/{pth_id}', 'PhieutrahangController@excel_pth');
	Route::get('/taopth/timsdt_khpth','PhieutrahangController@timsdt_khpth')->name('taopth.timsdt_khpth');
	Route::post('/dynamic-field/insertddh', 'PhieutrahangController@insertddh')->name('dynamic-field.insertddh');
//phieutrancc
	Route::get('/pdf-ptncc/{ptncc_id}', 'PhieutranhacungcapController@pdf_ptncc');
	Route::get('/tao-ptncc/{pnk_id}','PhieutranhacungcapController@gettao_ptncc');
	Route::post('/dynamic-field/insertncc', 'PhieutranhacungcapController@insertncc')->name('dynamic-field.insertncc');
	Route::get('/danhsach-ptncc','PhieutranhacungcapController@getdanhsach_ptncc');
	Route::get('/excel-ptncc/{ptncc_id}', 'PhieutranhacungcapController@excel_ptncc');
	Route::get('/chitiet-ptncc/{ptncc_id}','PhieutranhacungcapController@getchitiet_ptncc');
//baocao nhap-xuat-ton theo ncc
	Route::post('/excel-bcncc', 'BaocaonccController@excel_bcncc');
	Route::get('/tao-bcncc','BaocaonccController@gettao_bcncc');
	Route::post('/xem-bcncc','BaocaonccController@postxem_bcncc');
	Route::post('/pdf-bcncc','BaocaonccController@postpdf_bcncc');
//baocao nhap-xuat theo khách hàng
	Route::post('/excel-bckh', 'BaocaokhController@excel_bckh');
	Route::get('/tao-bckh','BaocaokhController@gettao_bckh');
	Route::post('/xem-bckh','BaocaokhController@postxem_bckh');
	Route::post('/pdf-bckh','BaocaokhController@postpdf_bckh');
	Route::get('/taobaocaokh/timsdt_bc_kh','BaocaokhController@timsdt_bc_kh')->name('taobaocaokh.timsdt_bc_kh');
//baocao ton kho tuc thoi 
	Route::post('/excel-bctk', 'BaocaotkController@excel_bctk');
	Route::get('/tao-bctk','BaocaotkController@gettao_bctk');
	Route::post('/xem-bctk','BaocaotkController@postxem_bctk');
	Route::post('/pdf-bctk','BaocaotkController@postpdf_bctk');

	//khachhang
	Route::get('/khachhang','KhachhangController@index')->name('khachhang.index');
	Route::get('/khachhang','KhachhangController@create')->name('khachhang.create');
	Route::get('/khachhang/edit/{id}','KhachhangController@edit')->name('khachhang.edit');
	Route::post('/khachhang/update/{id}','KhachhangController@update')->name('khachhang.update');
	Route::get('/khachhang/chitiet/{id}','KhachhangController@getdetail')->name('khachhang.chitiet');
	Route::post('/khachhang/search/{id}', 'KhachhangController@search')->name('khachhang.search');
	Route::get('/pdf-chitietcongno-kh/{id}', 'KhachhangController@pdf_chitietcongno_kh');
	Route::get('/excel-chitietcongno-kh/{id}', 'KhachhangController@excel_chitietcongno_kh')->name('khachhang.chitiet.excel');
	Route::get('/excel-chitietcongno-kh-time/{id}/{from_date}/{to_date}', 'KhachhangController@excel_chitietcongno_kh_time')->name('khachhang.chitiet.excel.time');
	Route::resource('/khachhang', 'KhachhangController');
	//phieuthu
	Route::get('/phieuthu','PhieuthuController@index')->name('phieuthu.index');
	Route::get('/phieuthu/timsdt_kh','PhieuthuController@timsdt_kh')->name('phieuthu.timsdt_kh');
	Route::get('/phieuthu/create','PhieuthuController@create')->name('phieuthu.create');

	Route::post('/dynamic-field/store', 'PhieuthuController@insert')->name('dynamic-field.store');

	Route::resource('/phieuthu', 'PhieuthuController');


	//dondathang
	Route::get('/danhsachdondathang','DonDatHangController@xem_danhsachdondathang');
	Route::get('/chitietdondathang/{ddh_id}','DonDatHangController@chitietdondathang');
	Route::get('/taodondathang','DonDatHangController@tao_dondathang')->name('taodondathang');
	Route::get('/pdf-ddh/{ddh_id}', 'DonDatHangController@pdf_ddh');
	Route::get('/pdf-pxk/{ddh_id}', 'DonDatHangController@pdf_pxk');
	Route::get('/pdf-phieukynhan/{ddh_id}', 'DonDatHangController@pdf_phieukynhan');
	Route::get('/dongia1','DonDatHangController@dongia');
	Route::get('/hanghoa1','DonDatHangController@hanghoa');
	Route::get('/taodondathang/timsdt_kh','DonDatHangController@timsdt_kh')->name('taodondathang.timsdt_kh');
	Route::post('/taodondathang/themkh_moi','DonDatHangController@store_kh_moi')->name('taodondathang.store_kh_moi');
	Route::post('/dynamic-field/insert1', 'DonDatHangController@insert')->name('dynamic-field.insert1');
	Route::post('/timkiem','DonDatHangController@timkiem')->name('dondathang.timkiem');
	Route::get('/excel-ddh/{ddh_id}', 'DonDatHangController@excel_ddh')->name('dondathang.excel');
	Route::get('/excel-ddh-time/{from_date}/{to_date}', 'DonDatHangController@excel_ddh_time')->name('dondathang.time.excel');
	//thongke
	Route::get('/thongke','ThongkeController@thongke');
	
//QUẢN LÝ BÁN HÀNG
	
	});
//KẾ TOÁN CÔNG NỢ
Route::group(['prefix'=>'ketoan','middleware'=>'Nhanvien_Login'],function(){
	Route::get('/tongquanketoan','NhanvienController@xem_tongquanketoan');
//QUẢN LÝ KHO HÀNG

	
//QUẢN LÝ CÔNG NỢ
	});