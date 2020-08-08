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
use App\nhacungcap;
session_start();

class HanghoaController extends Controller
{
    
    public function getdanhsach_hh(){
    	$hh=hanghoa::all();
    	return view('kho.hanghoa.danhsach_hh',['hh'=>$hh]);
    }
       public function gettao_hh(){
        $khohang=khohang::all();
        $ncc=nhacungcap::all();
        return view('kho.hanghoa.tao_hh',['khohang'=>$khohang],['ncc'=>$ncc]);
    }
	  public function gettinhtrang($tinhtrang){
          $output='';
       if($tinhtrang==1){
        $hh=DB::table('hanghoa')
        ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
        ->join('khohang','hanghoa.kho_id','=','khohang.kho_id')
        ->where('hanghoa.hh_soluong','>=',10)->get();
              $output.="<thead>
          <tr>
           
            <th>Tên sản phẩm</th>
             <th>Mã sản phẩm</th>
            <th>Kho</th>
            <th>Nhóm</th>
            <th>Số lượng</th>
            <th width='200px'>Tình trạng hàng hóa</th>
    
          </tr>
        </thead>
        <tbody>";
        foreach($hh as $key => $dshh){
             $output.='
              <td>'.$dshh->hh_ten.'</td>
             <td>HH00'. $dshh->hh_id.'</td>
               <td>'.$dshh->kho_ten.'</td>
                  <td>'.$dshh->nhom_ten.'</td>
            <td style="color: black;"><b>'.$dshh->hh_soluong.'</b></td>';

            if($dshh->hh_soluong>=10){
      $output.=   '<td><button class="button button1">Còn hàng</button></td>';}
                               if($dshh->hh_soluong>=1 && $dshh->hh_soluong<=9){
     $output.= ' <td><button  class="button button2">Sắp hết hàng</button></td>';}
                          if($dshh->hh_soluong==0){
       $output.= ' <td><button class="button button3">Hết hàng</button></td>';}
        
        $output.='</tr>
             ';
        }
          $output.='</tbody>';
            echo $output;
       }
       elseif ($tinhtrang==2){
          $hh=DB::table('hanghoa')
           ->join('khohang','hanghoa.kho_id','=','khohang.kho_id')
           ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
          ->whereBetween('hanghoa.hh_soluong',[1,9])->get();
              $output.="<thead>
          <tr>
           
            <th>Tên sản phẩm</th>
             <th>Mã sản phẩm</th>
            <th>Kho</th>
            <th>Nhóm</th>
            <th>Số lượng</th>
            <th width='200px'>Tình trạng hàng hóa</th>
    
          </tr>
        </thead>
        <tbody>";
        foreach($hh as $key => $dshh){
             $output.='
              <td>'.$dshh->hh_ten.'</td>
             <td>HH00'. $dshh->hh_id.'</td>
               <td>'.$dshh->kho_ten.'</td>
                  <td>'.$dshh->nhom_ten.'</td>
            <td style="color: black;"><b>'.$dshh->hh_soluong.'</b></td>';

            if($dshh->hh_soluong>=10){
      $output.=   '<td><button class="button button1">Còn hàng</button></td>';}
                               if($dshh->hh_soluong>=1 && $dshh->hh_soluong<=9){
     $output.= ' <td><button  class="button button2">Sắp hết hàng</button></td>';}
                          if($dshh->hh_soluong==0){
       $output.= ' <td><button class="button button3">Hết hàng</button></td>';}
        
        $output.='</tr>
             ';
        }
          $output.='</tbody>';
            echo $output;
       }
        elseif ($tinhtrang==3){
          $hh=DB::table('hanghoa')
           ->join('khohang','hanghoa.kho_id','=','khohang.kho_id')
           ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
          ->where('hanghoa.hh_soluong','=',0)->get();
              $output.="<thead>
          <tr>
           
            <th>Tên sản phẩm</th>
             <th>Mã sản phẩm</th>
            <th>Kho</th>
            <th>Nhóm</th>
            <th>Số lượng</th>
            <th width='200px'>Tình trạng hàng hóa</th>
    
          </tr>
        </thead>
        <tbody>";
        foreach($hh as $key => $dshh){
             $output.='
              <td>'.$dshh->hh_ten.'</td>
             <td>HH00'. $dshh->hh_id.'</td>
               <td>'.$dshh->kho_ten.'</td>
                  <td>'.$dshh->nhom_ten.'</td>
            <td style="color: black;"><b>'.$dshh->hh_soluong.'</b></td>';

            if($dshh->hh_soluong>=10){
      $output.=   '<td><button class="button button1">Còn hàng</button></td>';}
                               if($dshh->hh_soluong>=1 && $dshh->hh_soluong<=9){
     $output.= ' <td><button  class="button button2">Sắp hết hàng</button></td>';}
                          if($dshh->hh_soluong==0){
       $output.= ' <td><button class="button button3">Hết hàng</button></td>';}
        
        $output.='</tr>
             ';
        }
          $output.='</tbody>';
            echo $output;
       }
       elseif  ($tinhtrang==0){
                 $hh=hanghoa::all();
      
               $output.="<thead>
          <tr>
           
            <th>Tên sản phẩm</th>
             <th>Mã sản phẩm</th>
            <th>Kho</th>
            <th>Nhóm</th>
            <th>Số lượng</th>
            <th width='200px'>Tình trạng hàng hóa</th>
    
          </tr>
        </thead>
        <tbody>";
        foreach($hh as $key => $dshh){
             $output.='
              <td>'.$dshh->hh_ten.'</td>
             <td>HH00'. $dshh->hh_id.'</td>
               <td>'.$dshh->khohang->kho_ten.'</td>
                  <td>'.$dshh->nhomhanghoa->nhom_ten.'</td>
            <td style="color: black;"><b>'.$dshh->hh_soluong.'</b></td>';

            if($dshh->hh_soluong>=10){
      $output.=   '<td><button class="button button1">Còn hàng</button></td>';}
                               if($dshh->hh_soluong>=1 && $dshh->hh_soluong<=9){
     $output.= ' <td><button  class="button button2">Sắp hết hàng</button></td>';}
                          if($dshh->hh_soluong==0){
       $output.= ' <td><button class="button button3">Hết hàng</button></td>';}
        
        $output.='</tr>
             ';
        }
          $output.='</tbody>';
              echo $output;
       }

    }
      public function getton_hh(){
        $hh=hanghoa::all();
      
         $output='';
            $output.="<thead>
          <tr>
           
            <th>Tên sản phẩm</th>
             <th>Mã sản phẩm</th>
            <th>Kho</th>
            <th>Nhóm</th>
            <th>Số lượng</th>
            <th width='200px'>Tình trạng hàng hóa</th>
    
          </tr>
        </thead>
        <tbody>";
        foreach($hh as $key => $dshh){
             $output.='
              <td>'.$dshh->hh_ten.'</td>
             <td>HH00'. $dshh->hh_id.'</td>
               <td>'.$dshh->khohang->kho_ten.'</td>
                  <td>'.$dshh->nhomhanghoa->nhom_ten.'</td>
            <td style="color: black;"><b>'.$dshh->hh_soluong.'</b></td>';

            if($dshh->hh_soluong>=10){
      $output.=   '<td><button class="button button1">Còn hàng</button></td>';}
                               if($dshh->hh_soluong>=1 && $dshh->hh_soluong<=9){
     $output.= ' <td><button  class="button button2">Sắp hết hàng</button></td>';}
                          if($dshh->hh_soluong==0){
       $output.= ' <td><button class="button button3">Hết hàng</button></td>';}
        
        $output.='</tr>
             ';
        }
          $output.='</tbody>';
         
     
       return view('kho.hanghoa.ton_hh')->with('hh',$hh)->with('output',$output);
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
        $hh->hh_donvitinh=$request->hh_donvitinh;
     	$hh->nhom_id=$request->nhom_id;
     	$hh->kho_id=$request->kho_id;
        $hh->hh_soluong=0;
     	$hh->hh_dongia=$request->hh_dongia;
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
        $hh->hh_donvitinh=$request->hh_donvitinh;
     	$hh->nhom_id=$request->nhom_id;
     	$hh->kho_id=$request->kho_id;
     	$hh->hh_dongia=$request->hh_dongia;
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
      public function nhh_hh_theoncc(Request $request){

    
      //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=nhomhanghoa::select('nhom_ten','nhom_id')->where('ncc_id',$request->ncc_id)->get();
          
            $output = '';
          
           $output = ' <option value="">--Chọn nhóm hàng hóa--</option>';
                
                foreach($data as $key => $value){
                    $output.='<option value="'.$value->nhom_id.'">'.$value->nhom_ten.'</option>';
                

            }

            echo $output;
        
  }
   public function getxoa_hh($hh_id){
        $hh=hanghoa::find($hh_id);
        $hh->delete();
        return redirect('banhang/danhsach-hh')->with('thongbao','Bạn đã xóa thành công');
    }
    
}
