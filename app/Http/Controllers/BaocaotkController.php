<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\khohang;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use App\Exports\Baocaotk_Export;
use Maatwebsite\Excel\Facades\Excel;
use DateTime;
session_start();

class BaocaotkController extends Controller
{
    
    public function gettao_bctk(){
        $khohang=khohang::all();
    	return view('kho.baocao_tk.bctk')->with('khohang',$khohang);
    }
        public function postpdf_bctk(Request $request){
  //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
       $current_day = Carbon::now('Asia/Ho_Chi_Minh');
      
       $date=date("Y-m-d H:i:s", strtotime($current_day));
   
          $data= DB::table('hanghoa')
       ->where('kho_id',$request->kho_id)
       ->get();
$khohang=khohang::find($request->kho_id);
        $data4 = [
        'date' => $date,
        'khohang'=>$khohang,
        'data'=>$data,
    ];
   
   
     $pdf = PDF::loadView('kho.baocao_tk.pdf_bctk',$data4);
 $pdf->setPaper('A4','landscape');
    return $pdf->stream();
    }
     public function excel_bctk(Request $request){
  //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
      $current_day = Carbon::now('Asia/Ho_Chi_Minh');
      
       $date=date("Y-m-d H:i:s", strtotime($current_day));
   
          $data= DB::table('hanghoa')
       ->where('kho_id',$request->kho_id)
       ->get();
$khohang=khohang::find($request->kho_id);
        $data4 = [
        'date' => $date,
        'khohang'=>$khohang,
        'data'=>$data,
    ];
   
   
    return Excel::download(new Baocaotk_Export($date,$data,$khohang), 'Baocao_tonkho.xlsx');
    }
      public function postxem_bctk(Request $request){
  //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
      $current_day = Carbon::now('Asia/Ho_Chi_Minh');
      
       $date=date("Y-m-d H:i:s", strtotime($current_day));
   
          $data= DB::table('hanghoa')
       ->where('kho_id',$request->kho_id)
       ->get();
     $output='';
     $output.='
 
               <thead>
                <tr>
                   <th > Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th> Đơn vị</th>
                      <th> Số lượng tồn</th>
                       <th> Đơn giá</th>
                        <th>Giá trị</th>
                     
                </tr>
            
             
               </thead>
               <tbody>';
          foreach ($data as $key => $value) {
            $tck=0;
              $output.='<tr>
                <td>HH00'.$value->hh_id .'</td>
                <td>'.$value->hh_ten.'</td>
                <td>'.$value->hh_donvitinh.'</td>
                <td>'.$value->hh_soluong.'</td>
                <td>'.number_format($value->hh_dongia,0,',','.').'</td>
                <td>'.number_format($value->hh_soluong*$value->hh_dongia,0,',','.').'</td></tr>';
               
           
              
              
          }
          $output.= "</tbody>";
          return $output;
    
  
  
}
   
}
    
   

