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
       public function getdanhsach_nv(){
        $nv=User::all();
        return view('nhanvien.danhsach_nv',['nv'=>$nv]);
    }
     public function gettao_nv(){
      
        return view('nhanvien.tao_nv');
    }
      public function getxoa_nv($nv_id){
      $user=User::find($nv_id);
      $user->delete();
      return redirect('/banhang/danhsach-nv')->with('thongbao','Bạn đã xóa nhân viên thành công');
    }
      public function getsua_nv($nv_id){
       
        $nv=User::find($nv_id);
        return view('nhanvien.sua_nv',['nv'=>$nv]);
    }
     public function postsua_nv(Request $request,$id){
                 $this->validate($request,[
                'name'=>'required|min:3',
                'sdt'=> 'required|min:10|max:10',
                'diachi'=>'required',
                

        ],
        [
                'name.required'=>'Bạn chưa nhập tên người dùng',
                'name.min'=>'Tên người dùng phải có ít nhất 3 ký tự',
                 'diachi.required'=>'Bạn chưa nhập địa chỉ',
                'sdt.required'=>'Bạn chưa nhập số điện thoại ',
                'sdt.min'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                'sdt.max'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
             
        ]);
        $user=User::find($id);
        $user->name=$request->name;
        $user->quyen=$request->quyen;
        $user->sdt=$request->sdt;
        $user->diachi=$request->diachi;
        if($request->changePassword=="on"){
            $this->validate($request,[
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',

        ],
        [
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chỉ được tối đa 32 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp',
        ]);
            $user->password=bcrypt($request->password);
        }
        $user->save();
        return redirect('/banhang/danhsach-nv')->with('thongbao','Sửa thông tin nhân viên thành công');
    }
      public function posttao_nv(Request $request){
        $this->validate($request,[
                'name'=>'required|min:3',
                'sdt'=> 'required|unique:nhanvien,sdt|min:10|max:10',
                'diachi'=>'required',
                'email'=>'required|email|unique:nhanvien,email',
                'password'=>'required|min:3|max:32',
                'passwordAgain'=>'required|same:password',

        ],
        [
                'name.required'=>'Bạn chưa nhập tên nhân viên',
                'name.min'=>'Tên người dùng phải có ít nhất 3 ký tự',
                'email.required'=>'Bạn chưa nhập email',
                'email.email'=>'Bạn chưa nhập đúng định dạng email',
                'email.unique'=>'Email đã tồn tại',
                'password.required'=>'Bạn chưa nhập mật khẩu',
                'password.min'=>'Mật khẩu phải có ít nhất 3 ký tự',
                'password.max'=>'Mật khẩu chỉ được tối đa 32 ký tự',
                'passwordAgain.required'=>'Bạn chưa nhập lại mật khẩu',
                'passwordAgain.same'=>'Mật khẩu nhập lại chưa khớp',
                'diachi.required'=>'Bạn chưa nhập địa chỉ',
                'sdt.required'=>'Bạn chưa nhập số điện thoại ',
                'sdt.unique'=>'Số điện thoại đã tồn tại',
                'sdt.min'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                'sdt.max'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
        ]);
        $user=new User;
        $user->name=$request->name;
        $user->email=$request->email;
        $user->sdt=$request->sdt;
        $user->diachi=$request->diachi;
        $user->password= bcrypt($request->password);
        $user->quyen=$request->quyen;
        $user->save();
        return redirect('/banhang/danhsach-nv')->with('thongbao','Thêm nhân viên thành công');
        
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
     	if(Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
     	{
     		return redirect('banhang/tongquanbanhang');
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
