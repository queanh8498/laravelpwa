<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\nhacungcap;
session_start();

class NhacungcapController extends Controller
{
    
    public function getdanhsach_ncc(){
        $ncc=nhacungcap::all();
    	return view('kho.nhacungcap.danhsach_ncc')->with('ncc',$ncc);
    }
    public function gettao_ncc(){
      
        return view('kho.nhacungcap.tao_ncc');
    }
   
     public function posttao_ncc(Request $request){
        $this->validate($request,[
                'ncc_ten'=> 'required|unique:nhacungcap,ncc_ten|min:1|max:100',
                'ncc_diachi'=>'required',
                'ncc_sdt'=> 'required|unique:nhacungcap,ncc_sdt|min:10|max:10'

        ],
        [
                'ncc_ten.required'=>'Bạn chưa nhập tên nhà cung cấp',
                'ncc_ten.unique'=>'Tên nhà cung cấp đã tồn tại',
                'ncc_ten.min'=>'Tên nhà cung cấp phải có độ dài từ 1 cho đến 100 ký tự',
                'ncc_ten.max'=>'Tên nhà cung cấp phải có độ dài từ 1 cho đến 100 ký tự',
                'ncc_diachi.required'=>'Bạn chưa nhập địa chỉ nhà cung cấp',
                'ncc_sdt.required'=>'Bạn chưa nhập số điện thoại nhà cung cấp',
                'ncc_sdt.unique'=>'Số điện thoại nhà cung cấp đã tồn tại',
                'ncc_sdt.min'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                'ncc_sdt.max'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                
        ]);
   
        $ncc =new nhacungcap;
        $ncc->ncc_ten=$request->ncc_ten;
        $ncc->ncc_diachi=$request->ncc_diachi;
        $ncc->ncc_sdt=$request->ncc_sdt;
        $ncc->save();
        return redirect('banhang/danhsach-ncc')->with('thongbao','Tạo nhà cung cấp thành công');
        
    }
     public function getsua_ncc($ncc_id){
       $ncc=nhacungcap::find($ncc_id);
        return view('kho.nhacungcap.sua_ncc',['ncc'=>$ncc]);
    }
     public function postsua_ncc(Request $request,$ncc_id){
            
        $this->validate($request,[
                'ncc_ten'=> 'required|unique:nhacungcap,ncc_ten|min:1|max:100',
                'ncc_diachi'=>'required',
                'ncc_sdt'=> 'required|min:10|max:10'

        ],
        [
                'ncc_ten.required'=>'Bạn chưa nhập tên nhà cung cấp',
                'ncc_ten.unique'=>'Tên nhà cung cấp đã tồn tại',
                'ncc_ten.min'=>'Tên nhà cung cấp phải có độ dài từ 1 cho đến 100 ký tự',
                'ncc_ten.max'=>'Tên nhà cung cấp phải có độ dài từ 1 cho đến 100 ký tự',
                'ncc_diachi.required'=>'Bạn chưa nhập địa chỉ nhà cung cấp',
                'ncc_sdt.required'=>'Bạn chưa nhập số điện thoại nhà cung cấp',
                'ncc_sdt.min'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                'ncc_sdt.max'=>'Số điện thoại nhà cung cấp phải có độ dài 10 số',
                
        ]);
       $ncc=nhacungcap::find($ncc_id);
        $ncc->ncc_ten=$request->ncc_ten;
        $ncc->ncc_diachi=$request->ncc_diachi;
        $ncc->ncc_sdt=$request->ncc_sdt;
        $ncc->save();
        return redirect('banhang/danhsach-ncc')->with('thongbao','Sửa thông tin nhà cung cấp thành công');
 
    }
    
}
