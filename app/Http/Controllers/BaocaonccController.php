<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\nhacungcap;
use App\Exports\Baocaoncc_Export;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
session_start();

class BaocaonccController extends Controller
{
    
    public function gettao_bcncc(){
        $ncc=nhacungcap::all();
    	return view('kho.baocao_ncc.bcncc')->with('ncc',$ncc);
    }
    public function postpdf_bcncc(Request $request){
  //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
      $from=date("Y-m-d H:i:s", strtotime($request->tungay));
      $to_ht=date("Y-m-d H:i:s", strtotime($request->denngay));
      $to=date("Y-m-d H:i:s", strtotime($request->denngay. ' + 1 days'));
      $data= DB::table('hanghoa')
       ->join('nhomhanghoa','nhomhanghoa.nhom_id','=','hanghoa.nhom_id')
       ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
       ->where('nhacungcap.ncc_id',$request->ncc_id)
       ->get();
       $ncc=nhacungcap::find($request->ncc_id);
        $data4 = [
        'from' => $from,
        'to_ht'  => $to_ht,
        'to'  => $to,
        'ncc'=>$ncc,
        'data'=>$data,
    ];
   
   
     $pdf = PDF::loadView('kho.baocao_ncc.pdf_bcncc',$data4);
 $pdf->setPaper('A4','landscape');
    return $pdf->stream();
    }
 public function excel_bcncc(Request $request){
  //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
      $from=date("Y-m-d H:i:s", strtotime($request->tungay));
      $to=date("Y-m-d H:i:s", strtotime($request->denngay. ' + 1 days'));
      $to_ht=date("Y-m-d H:i:s", strtotime($request->denngay));
      $data= DB::table('hanghoa')
       ->join('nhomhanghoa','nhomhanghoa.nhom_id','=','hanghoa.nhom_id')
       ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
       ->where('nhacungcap.ncc_id',$request->ncc_id)
       ->get();
       $ncc=nhacungcap::find($request->ncc_id);
        $data4 = [
        'from' => $from,
        'to'  => $to,
        'to_ht'  => $to_ht,
        'ncc'=>$ncc,
        'data'=>$data,
    ];
   
   
    return Excel::download(new Baocaoncc_Export($from,$to,$data,$ncc,$to_ht), 'Baocao_nhacungcap.xlsx');
    }
      public function postxem_bcncc(Request $request){

       //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
       $from=date("Y-m-d H:i:s", strtotime($request->tungay));
       $to=date("Y-m-d H:i:s", strtotime($request->denngay. ' + 1 days'));
          $data= DB::table('hanghoa')
       ->join('nhomhanghoa','nhomhanghoa.nhom_id','=','hanghoa.nhom_id')
       ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
       ->where('nhacungcap.ncc_id',$request->ncc_id)
       ->get();

if($from>=$to ||$request->tungay==''||$request->denngay==''){
  echo "<input  style='color:red;' type='text' id='check' value='Ngày không hợp lệ' readonly='' class='form-control'>";
}
else{
     $output='';
     $output.='
 
               <thead>
                <tr>
                   <th rowspan="2"> Mã hàng hóa</th>
                    <th rowspan="2">Tên hàng hóa</th>
                    <th rowspan="2"> Đơn vị</th>
                      <th colspan="2"> Tồn đầu kỳ</th>
                       <th  colspan="2"> Nhập trong kỳ</th>
                        <th  colspan="2"> Xuất trong kỳ </th>
                      <th  colspan="2"> Tồn cuối kỳ</th>
                </tr>
                <tr>    
                
                <th>Số lượng</th>
                 <th>Đơn giá</th>  
                  <th>Số lượng</th>
                 <th>Đơn giá</th>  
                  <th>Số lượng</th>
                 <th>Đơn giá</th>  
                  <th>Số lượng</th>
                 <th>Đơn giá</th>  
                         
                </tr>
             
               </thead>
               <tbody>';
          foreach ($data as $key => $value) {
            $tck=0;
              $output.='<tr>
               <td>HH00'.$value->hh_id .'</td>
               <td>'.$value->hh_ten.'</td>
               <td>'.$value->hh_donvitinh.'</td>';
                 $data1=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->where('phieunhapkho.pnk_ngaynhapkho','<', $from)->groupBy('hanghoa.hh_id')->get();
                 if(!$data1->isEmpty()){
                foreach ($data1 as $key1 => $value1) {
                    
            $output.=  '<td>'.$value1->quantity.'</td>
                        <td>'.number_format($value1->total,0,',',',').'</td>';
                      $tck=$tck+$value1->quantity;
                    }}
                    else{

            $output.=  '<td>0</td>
                        <td>0</td>';
                    }
               $data2=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieunhapkho.pnk_ngaynhapkho', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitiettrancc')
               ->join('phieutrancc','phieutrancc.ptncc_id','=','chitiettrancc.ptncc_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrancc.hh_id')
               ->select(DB::raw('sum(ctncc_soluong) as quantity,sum(ctncc_soluong*ctncc_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieutrancc.ptncc_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
               if(!$data2->isEmpty()){
                foreach ($data2 as $key2 => $value2) {
                    
            $output.=  '<td>'.$value2->quantity.'</td>
                        <td>'.number_format($value2->total,0,',',',').'</td>';
                      $tck=$tck+$value2->quantity;
                    }}
                    else{

            $output.=  '<td>0</td>
                        <td>0</td>';
                    }
                     if(!$data3->isEmpty()){
                foreach ($data3 as $key3 => $value3) {
                    
            $output.=  '<td>'.$value3->quantity.'</td>
                        <td>'.number_format($value3->total,0,',',',').'</td>';
                      $tck=$tck-$value3->quantity;
                    }}
                    else{

            $output.=  '<td>0</td>
                        <td>0</td>';
                    }
              $output.='<td>'.$tck.'</td>
              
             
               <td>'.number_format($tck*$value->hh_dongia,0,',',',').'</td></tr>';
          }
          $output.= "</tbody>";
          return $output;
    }
  
  
}
}
    
   

