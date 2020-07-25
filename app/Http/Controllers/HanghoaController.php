<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\nhomhanghoa;
use App\khohang;
use App\hanghoa;
session_start();

class HanghoaController extends Controller
{
    
    public function getdanhsach_hh(){
    	$hh=hanghoa::all();
    	return view('kho.hanghoa.danhsach_hh',['hh'=>$hh]);
    }
       public function gettao_hh(){
        $khohang=khohang::all();
        $nhom=nhomhanghoa::all();
        return view('kho.hanghoa.tao_hh',['khohang'=>$khohang],['nhom'=>$nhom]);
    }
   public function posttao_hh(Request $request){
   		$this->validate($request,[
   				'hh_ten'=> 'unique:hanghoa,hh_ten',
                'hh_thongtin'=>'required'

     	],
     	[
     			'hh_ten.unique'=>'Tên hàng hóa đã tồn tại',
                'hh_thongtin.required'=>'Bạn chưa nhập thông tin hàng hóa'
     	]);
   
        $hh =new hanghoa;
     	$hh->hh_ten=$request->hh_ten;
     	$hh->nhom_id=$request->nhom_id;
     	$hh->kho_id=$request->kho_id;
     	$hh->hh_dongia=$request->hh_dongia;
     	$hh->hh_soluong=$request->hh_soluong;
     	$hh->hh_thongtin=$request->hh_thongtin;
     	date_default_timezone_set('Asia/Ho_Chi_Minh');
        $hh->hh_ngaytaomoi = now();
        $hh->hh_ngaycapnhat= now();
          $get_image = $request->file('hh_hinh');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/hanghoa',$new_image);
            $hh->hh_hinh = $new_image;
                   
        }
        else{
            $hh->hh_hinh="";
        }
      
             $hh->save();
         return redirect('banhang/danhsach-hh')->with('thongbao','Tạo hàng hóa thành công');  
    
        
        
    }
 
   public function getsua_hh($hh_id){
     
    	$hh=hanghoa::find($hh_id);
    	$khohang=khohang::all();
    	$nhom=nhomhanghoa::all();
    	return view('kho.hanghoa.sua_hh')->with('hh',$hh)->with('khohang',$khohang)->with('nhom',$nhom);
    }
   public function postsua_hh(Request $request,$hh_id){
     				$this->validate($request,[
   				'hh_ten'=> 'required',
                'hh_thongtin'=>'required'

     	],
     	[
     			'hh_ten.required'=>'Bạn chưa nhập tên hàng hóa',
                'hh_thongtin.required'=>'Bạn chưa nhập thông tin hàng hóa'
     	]);
     	$hh=hanghoa::find($hh_id);
     	$hh->hh_ten=$request->hh_ten;
     	$hh->nhom_id=$request->nhom_id;
     	$hh->kho_id=$request->kho_id;
     	$hh->hh_dongia=$request->hh_dongia;
     	$hh->hh_soluong=$request->hh_soluong;
     	$hh->hh_thongtin=$request->hh_thongtin;
     	date_default_timezone_set('Asia/Ho_Chi_Minh');
        $hh->hh_ngaycapnhat= now();
          $get_image = $request->file('hh_hinh');
      if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image =  $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('upload/hanghoa',$new_image);
            $hh->hh_hinh = $new_image;
            
        }
            $hh->save();
            return redirect('banhang/danhsach-hh')->with('thongbao','Sửa thông tin hàng hóa thành công');
        

  
        

    }
    
}
