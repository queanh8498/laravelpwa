<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\khohang;
session_start();

class KhohangController extends Controller
{
    
    public function getdanhsach_kho(){
        $khohang=khohang::all();
    	return view('kho.khohang.danhsach_kho')->with('khohang',$khohang);
    }
    public function gettao_kho(){
      
    	return view('kho.khohang.tao_kho');
    }
   
    
     public function posttao_kho(Request $request){
     	$this->validate($request,[
     			'kho_ten'=> 'required|unique:khohang,kho_ten|min:1|max:100',
                'kho_diachi'=>'required'

     	],
     	[
     			'kho_ten.required'=>'Bạn chưa nhập tên kho',
                'kho_ten.unique'=>'Tên kho đã tồn tại',
     			'kho_ten.min'=>'Tên kho phải có độ dài từ 1 cho đến 100 ký tự',
     			'kho_ten.max'=>'Tên kho phải có độ dài từ 1 cho đến 100 ký tự',
                'kho_diachi.required'=>'Bạn chưa nhập địa chỉ kho'
     	]);
   
     	$khohang =new khohang;
     	$khohang->kho_ten=$request->kho_ten;
   		$khohang->kho_diachi=$request->kho_diachi;
     	$khohang->save();
     	return redirect('banhang/danhsach-kho')->with('thongbao','Tạo kho thành công');
    	
    }
  public function getsua_kho($kho_id){
       $khohang=khohang::find($kho_id);
    	return view('kho.khohang.sua_kho',['khohang'=>$khohang]);
    }
     public function postsua_kho(Request $request,$kho_id){
     		
    	$this->validate($request,[
     			'kho_ten'=> 'required|min:1|max:100',
                'kho_diachi'=>'required'

     	],
     	[
     			'kho_ten.required'=>'Bạn chưa nhập tên kho',
               
     			'kho_ten.min'=>'Tên kho phải có độ dài từ 1 cho đến 100 ký tự',
     			'kho_ten.max'=>'Tên kho phải có độ dài từ 1 cho đến 100 ký tự',
                'kho_diachi.required'=>'Bạn chưa nhập địa chỉ kho'
     	]);
        $khohang=khohang::find($kho_id);
     	$khohang->kho_ten=$request->kho_ten;
   		$khohang->kho_diachi=$request->kho_diachi;
     	$khohang->save();
     	return redirect('banhang/danhsach-kho')->with('thongbao','Sửa thông tin kho thành công');
 
    }
     public function getxoa_kho($kho_id){
        $khohang=khohang::find($kho_id);
        $khohang->delete();
        return redirect('banhang/danhsach-kho')->with('thongbao','Bạn đã xóa thành công');
    }
}
