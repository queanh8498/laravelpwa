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
use App\hanghoa;
use App\khohang;
use App\phieunhapkho;
use App\chitietphieunhap;
use Validator;
session_start();

class PhieunhapkhoController extends Controller
{
    
   
    public function gettao_pnk(){
      $kho=khohang::all();
      $nhom=nhomhanghoa::all();
    	return view('kho.phieunhapkho.tao_pnk')->with('nhom',$nhom)->with('kho',$kho);
    }
     public function getdanhsach_pnk(){
     $pnk=phieunhapkho::all();
      return view('kho.phieunhapkho.danhsach_pnk')->with('pnk',$pnk);
    }
       public function getchitiet_pnk($pnk_id){
    $pnk=phieunhapkho::find($pnk_id);
    $ctpn=DB::table('chitietphieunhap')->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')->where('pnk_id',$pnk_id)->get();

      return view('kho.phieunhapkho.chitiet_pnk')->with('pnk',$pnk)->with('ctpn',$ctpn);
    }
    
     public function dongia(Request $request){
  
    //it will get price if its id match with product id
    $p=hanghoa::select('hh_dongia')->where('hh_id',$request->id)->first();
    
      return response()->json($p);
  }

public function hanghoa(Request $request){

    
      //if our chosen id and products table prod_cat_id col match the get first 100 data 

        //$request->id here is the id of our chosen option id
        $data=hanghoa::select('hh_ten','hh_id')->where([['nhom_id',$request->id],['kho_id',$request->kho_id]])->get();
          
            $output = '';
          
           $output = ' <option value="">--Chọn hàng hóa--</option>';
                
                foreach($data as $key => $value){
                    $output.='<option value="'.$value->hh_id.'">'.$value->hh_ten.'</option>';
                

            }
            echo $output;
        
  }
function insert(Request $request)
    {
      if($request->ajax())
     {
      $rules = array(
        'nhom_id.*'=>'required',
         'hh_id.*'=>'required',
       'ctpn_soluong.*'  => 'required'
      
      
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
         
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
        
      }
     $checkout_code = substr(md5(microtime()),rand(0,26),5);
     $pnk =new phieunhapkho;
     $pnk->pnk_id=$checkout_code;
      $pnk->id=$request->nv_id;
      $pnk->kho_id=$request->kho_id;
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $pnk->pnk_ngaynhapkho = now();
      $pnk->save();


       $hh_id = $request->hh_id;
      $ctpn_soluong = $request->ctpn_soluong;
      $ctpn_dongia=$request->ctpn_dongia;
       for($count1 = 0; $count1 < count($hh_id); $count1++)
      {
        $product= DB::table('hanghoa')->where('hh_id',$hh_id[$count1])->get();
           foreach ($product as $key => $value) {
             $value1=$value->hh_soluong+$ctpn_soluong[$count1];
                $data1 = array();
             $data1['hh_soluong'] =$value1;
              DB::table('hanghoa')->where('hh_id',$hh_id[$count1] )->update($data1); 
      }}
      for($count = 0; $count < count($hh_id); $count++)
      {
       $data = array(
        'pnk_id'=>$checkout_code,
        'hh_id' => $hh_id[$count],
        'ctpn_soluong'  => $ctpn_soluong[$count],
        'ctpn_dongia'  => $ctpn_dongia[$count]
       );
       $insert_data[] = $data; 
      }
      
      chitietphieunhap::insert($insert_data);
      return response()->json([
       'success'  => 'Phiếu nhập được tạo thành công.'
      ]);
     
     }
    }
     
     
    
}
