<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\User;
session_start();

class NhanvienController extends Controller
{
    
    public function xem_tongquanbanhang(){
       
    	return view('banhang.tongquan');
    }
    public function xem_tongquanketoan(){
       
        return view('ketoan.tongquan');
    }
     public function getdangnhap(){
    	return view('admin_login');
    }
     public function postdangnhap(Request $request){
    	$this->validate($request,[
     		
     			'email'=>'required',
     			'password'=>'required|min:3|max:32',
     			
     	],
     	[
                'email.required'=>'Bạn chưa nhập email',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chỉ được tối đa 32 ký tự',      
     	]);
     	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password,'quyen'=>'1']))
     	{
     		return redirect('banhang/tongquanbanhang');
     	}
        elseif (Auth::attempt(['email'=>$request->email,'password'=>$request->password,'quyen'=>'2']))
        {
            return redirect('ketoan/tongquanketoan');
        }
     	else 
     	{
   
   		return redirect('/dangnhap')->with('thongbao','Đăng nhập không thành công');
     	}
    }
      public function getdangxuat(){
        Auth::logout();
        return redirect ('/dangnhap');
    }
   
}
