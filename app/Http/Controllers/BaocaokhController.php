<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\khachhang;
use Barryvdh\DomPDF\Facade as PDF;
session_start();

class BaocaokhController extends Controller
{
    
    public function gettao_bckh(){
        $kh=khachhang::all();
    	return view('kho.baocao_kh.bckh')->with('kh',$kh);
    }
    public function timsdt_bc_kh(Request $request){
       if($request->ajax()){
            $output = '';
            $output1 = '';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('khachhang')
                    ->where('kh_sdt', 'like', '%'.$query.'%')
                    ->get();
            }
     
            $total_row = $data->count();

            if($total_row > 0){
                foreach($data as $row){
                    $output .= $row->kh_ten;
                    $output1 .= $row->kh_id;
                }
            }
            else{
                $output =
                "Không có khách hàng";
            }
            $data = array(
                //'table_data'  => $output,
                'kh_ten' => $output,
                'kh_id' => $output1,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
   
    public function postpdf_bckh(Request $request){

      $from=date("Y-m-d H:i:s", strtotime($request->tungay));
      $to=date("Y-m-d H:i:s", strtotime($request->denngay));
        $data= DB::table('chitietdathang')
       ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
       ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
       ->where('dondathang.kh_id',$request->kh_id)
       ->groupBy('hanghoa.hh_id')
       ->get();
       $kh=khachhang::find($request->kh_id);
        $data4 = [
        'from' => $from,
        'to'  => $to,
        'kh'=>$kh,
        'data'=>$data,
    ];
 
     $pdf = PDF::loadView('kho.baocao_kh.pdf_bckh',$data4);
 $pdf->setPaper('A4','landscape');
    return $pdf->stream();
    }


     public function postxem_bckh(Request $request){

     
       $from=date("Y-m-d H:i:s", strtotime($request->tungay));
      $to=date("Y-m-d H:i:s", strtotime($request->denngay));
          $data= DB::table('chitietdathang')
       ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
       ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
       ->where('dondathang.kh_id',$request->kh_id)
       ->groupBy('hanghoa.hh_id')
       ->get();

if($from>=$to ){
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
                       <th  colspan="2"> Khách trả hàng</th>
                        <th  colspan="2"> Khách mua hàng </th>
                      <th  colspan="2">Tổng</th>
                </tr>
                <tr>    
                
              
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
                $data2=DB::table('chitiettrahang')
               ->join('phieutrahang','phieutrahang.pth_id','=','chitiettrahang.pth_id')
              ->join('dondathang','phieutrahang.ddh_id','=','dondathang.ddh_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrahang.hh_id')
               ->select(DB::raw('sum(ctth_soluong) as quantity,sum(ctth_soluong*ctth_dongia) as total'))
                ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$request->kh_id]])
               ->whereBetween('phieutrahang.pth_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitietdathang')
                  ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
                  ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
               ->select(DB::raw('sum(ctdh_soluong) as quantity,sum(ctdh_soluong*ctdh_dongia) as total'))
               ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$request->kh_id]])
               ->whereBetween('dondathang.ddh_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
        
              if(!$data2->isEmpty()){
                foreach ($data2 as $key2 => $value2) {
                    
            $output.=  '<td>'.$value2->quantity.'</td>
                        <td>'.number_format($value2->total,0,',','.').'</td>';
                      $tck=$tck-$value2->quantity;
                    }}
                    else{

            $output.=  '<td>0</td>
                        <td>0</td>';
                    }
                     if(!$data3->isEmpty()){
                foreach ($data3 as $key3 => $value3) {
                    
            $output.=  '<td>'.$value3->quantity.'</td>
                        <td>'.number_format($value3->total,0,',','.').'</td>';
                      $tck=$tck+$value3->quantity;
                    }}
                    else{

            $output.=  '<td>0</td>
                        <td>0</td>';
                    }
              $output.='<td>'.$tck.'</td>
              
             
               <td>'.number_format($tck*$value->hh_dongia,0,',','.').'</td></tr>';
          
             
          }
          $output.= "</tbody>";
          return $output;
    }
  
  
}
}
    
   

