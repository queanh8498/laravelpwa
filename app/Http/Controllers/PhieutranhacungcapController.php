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
use App\khachhang;
use App\dondathang;
use App\phieunhapkho;
use App\phieutrahang;
use App\chitiettrahang;
use App\chitietphieunhap;
use App\chitietdathang;
use App\phieutrancc;
use App\chitiettrancc;
use Validator;
session_start();

class PhieutranhacungcapController extends Controller
{
    
    public function gettao_ptncc($pnk_id){
      $pnk= phieunhapkho::find($pnk_id);
       $ctptncc=DB::table('chitietphieunhap')
     ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
     ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
    ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
     ->where('chitietphieunhap.pnk_id',$pnk_id)->get();
    	return view('kho.phieutrancc.tao_ptncc')->with('pnk',$pnk)->with('ctptncc',$ctptncc);
    }
     function insertncc(Request $request)
    {
      if($request->ajax())
     {
      $rules = array(
       
       'ctncc_soluong.*'  => 'required'
      
      
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
         
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
          }
    
      $ptncc =new phieutrancc;
   
      $ptncc->ncc_id=$request->ncc_id;
      $ptncc->pnk_id=$request->pnk_id;
      $ptncc->id=$request->nv_id;
      $ptncc->ptncc_trangthai=1;
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $ptncc->ptncc_ngaylap = now();
      $ptncc->save();
        $hh_id = $request->hh_id;
      $ctncc_soluong = $request->ctncc_soluong;
      $ctncc_dongia=$request->ctncc_dongia;
   for($count = 0; $count < count($hh_id); $count++)
      {
       $data = array(
        'ptncc_id' => $ptncc->ptncc_id,
        'hh_id' => $hh_id[$count],
        'ctncc_soluong'  => $ctncc_soluong[$count],
        'ctncc_dongia'  => $ctncc_dongia[$count]
       );
       $insert_data[] = $data; 
      }
      
      chitiettrancc::insert($insert_data);
      return response()->json([
       'success'  => 'Phiếu  trả nhà cung cấp được tạo thành công.'
      ]);
     
  
      }
       
     }
      public function getdanhsach_ptncc(){
     $ptncc=phieutrancc::all();
      return view('kho.phieutrancc.danhsach_ptncc')->with('ptncc',$ptncc);
    }
       public function getchitiet_ptncc($ptncc_id){
    $ptncc=phieutrancc::find($ptncc_id);
   $ctncc=DB::table('chitiettrancc')
     ->join('hanghoa','hanghoa.hh_id','=','chitiettrancc.hh_id')
     ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
    ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
   ->where('chitiettrancc.ptncc_id',$ptncc_id)->get();
   
    return view('kho.phieutrancc.chitiet_ptncc')->with('ptncc',$ptncc)->with('ctncc',$ctncc);

    }
    }
 

