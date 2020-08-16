<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\nhomhanghoa;
use App\nhacungcap;
session_start();

class NhomhanghoaController extends Controller
{
    
    public function getdanhsach_nhom(){
        $ncc=nhacungcap::all();
        $nhom=nhomhanghoa::all();

            $output='';
            $output.=" <thead>
          <tr>
            
            <th>Mã nhóm hàng hóa</th>
            <th>Nhà cung cấp</th>
            <th>Tên nhóm hàng hóa</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th style='width:60px;'>Hành động</th>
          </tr>
        </thead>
        <tbody>";
           foreach($nhom as $key => $dsnhom){
           $output.='<tr>
           
            <td>NHOM00'. $dsnhom->nhom_id .'</td>
            <td>'.$dsnhom->nhacungcap->ncc_ten.'</td>
            <td>'. $dsnhom->nhom_ten.'</td>';
            $nhom_ngaytaomoi=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaytaomoi));
            $nhom_ngaycapnhat=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaycapnhat));
            $output.=' <td>'. $nhom_ngaytaomoi.'</td>
            <td>'.$nhom_ngaycapnhat.'</td>
             <td>';
          $output.='<a href="banhang/sua-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                 <a onclick= "return confirm(\'Bạn có chắc là muốn xóa hàng hóa này không ?\')" href="banhang/xoa-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>';}
          $output.=" </tbody>";
      
          
    	return view('kho.nhomhanghoa.danhsach_nhom')->with('ncc',$ncc)->with('output',$output);
    }
    public function nhomhanghoa($ncc_id){
         if($ncc_id!=0)
       {
        
        $nhom=DB::table('nhomhanghoa')->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')->where('nhomhanghoa.ncc_id',$ncc_id)->get();
            $output='';
            $output.=" <thead>
          <tr>
            
            <th>Mã nhóm hàng hóa</th>
            <th>Nhà cung cấp</th>
            <th>Tên nhóm hàng hóa</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
            <th style='width:60px;'>Hành động</th>
          </tr>
        </thead>
        <tbody>";
           foreach($nhom as $key => $dsnhom){
           $output.='<tr>
           
            <td>NHOM00'. $dsnhom->nhom_id .'</td>
            <td>'.$dsnhom->ncc_ten.'</td>
             <td>'. $dsnhom->nhom_ten.'</td>';
            $nhom_ngaytaomoi=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaytaomoi));
            $nhom_ngaycapnhat=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaycapnhat));
            $output.=' <td>'. $nhom_ngaytaomoi.'</td>
            <td>'.$nhom_ngaycapnhat.'</td>
             <td>';
        $output.='<a href="banhang/sua-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active" title="Chỉnh sửa thông tin nhóm hàng hóa"></i></a>
                 <a onclick= "return confirm(\'Bạn có chắc là muốn xóa hàng hóa này không ?\')" href="banhang/xoa-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text" title="Xóa nhóm hàng hóa"></i>
            </td>
          </tr>';}
          $output.=" </tbody>";
         echo $output;
       }
       else{
          $nhom=nhomhanghoa::all();
            $output='';
            $output.=" <thead>
          <tr>
            
            <th>Mã nhóm hàng hóa</th>
            <th>Nhà cung cấp</th>
            <th>Tên nhóm hàng hóa</th>
            <th>Ngày tạo</th>
            <th>Ngày cập nhật</th>
          <th style='width:60px;'>Hành động</th>
          </tr>
        </thead>
        <tbody>";
           foreach($nhom as $key => $dsnhom){
           $output.='<tr>
           
            <td>NHOM00'.$dsnhom->nhom_id .'</td>
            <td>'.$dsnhom->nhacungcap->ncc_ten.'</td>
             <td>'. $dsnhom->nhom_ten.'</td>';
            $nhom_ngaytaomoi=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaytaomoi));
            $nhom_ngaycapnhat=date("d-m-Y H:i:s", strtotime($dsnhom->nhom_ngaycapnhat));
            $output.=' <td>'. $nhom_ngaytaomoi.'</td>
            <td>'.$nhom_ngaycapnhat.'</td>
             <td>';
         $output.='<a href="banhang/sua-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                 <a onclick= "return confirm(\'Bạn có chắc là muốn xóa hàng hóa này không ?\')" href="banhang/xoa-nhom/'.$dsnhom->nhom_id.'" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>';}
          $output.=" </tbody>";
         echo $output;
       }
    
     }
     


    public function gettao_nhom(){
      $ncc=nhacungcap::all();
    	return view('kho.nhomhanghoa.tao_nhom')->with('ncc',$ncc);
    }
     
     public function posttao_nhom(Request $request){
        $this->validate($request,[
                'nhom_ten'=> 'required|unique:nhomhanghoa,nhom_ten|min:1|max:100',
              

        ],
        [
                'nhom_ten.required'=>'Bạn chưa nhập tên nhóm hàng hóa',
                'nhom_ten.unique'=>'Tên nhóm hàng hóa đã tồn tại',
                'nhom_ten.min'=>'Tên nhóm hàng hóa phải có độ dài từ 1 cho đến 100 ký tự',
                'nhom_ten.max'=>'Tên nhóm hàng hóa phải có độ dài từ 1 cho đến 100 ký tự',
               
        ]);
   
        $nhom =new nhomhanghoa;
        $nhom->ncc_id=$request->ncc_id;
        $nhom->nhom_ten=$request->nhom_ten;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nhom->nhom_ngaytaomoi = now();
        $nhom->nhom_ngaycapnhat= now();
        $nhom->save();
        return redirect('banhang/danhsach-nhom')->with('thongbao','Tạo nhóm thành công');
        
    }
     public function getsua_nhom($nhom_id){
          $ncc=nhacungcap::all();
          $nhom=nhomhanghoa::find($nhom_id);
        return view('kho.nhomhanghoa.sua_nhom',['nhom'=>$nhom],['ncc'=>$ncc]);
    }
    
  public function postsua_nhom(Request $request,$nhom_id){
            
        $this->validate($request,[
                'nhom_ten'=> 'required|unique:nhomhanghoa,nhom_ten|min:1|max:100',
              

        ],
        [
                'nhom_ten.required'=>'Bạn chưa nhập tên nhóm hàng hóa',
                'nhom_ten.unique'=>'Tên nhóm hàng hóa đã tồn tại',
                'nhom_ten.min'=>'Tên nhóm hàng hóa phải có độ dài từ 1 cho đến 100 ký tự',
                'nhom_ten.max'=>'Tên nhóm hàng hóa phải có độ dài từ 1 cho đến 100 ký tự',
               
        ]);
        $nhom=nhomhanghoa::find($nhom_id);
        $nhom->ncc_id=$request->ncc_id;
        $nhom->nhom_ten=$request->nhom_ten;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $nhom->nhom_ngaycapnhat= now();
        $nhom->save();
        return redirect('banhang/danhsach-nhom')->with('thongbao','Sửa thông tin nhóm thành công');
 
    }
    
        public function getxoa_nhom($nhom_id){
        $nhom=nhomhanghoa::find($nhom_id);
        $nhom->delete();
        return redirect('banhang/danhsach-nhom')->with('thongbao','Bạn đã xóa thành công');
    }
  
}
