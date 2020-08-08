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
use DateTime;
session_start();

class BaocaotkController extends Controller
{
    
    public function gettao_bctk(){
        $khohang=khohang::all();
    	return view('kho.baocao_tk.bctk')->with('khohang',$khohang);
    }
        public function postpdf_bctk(Request $request){

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
      public function postxem_bctk(Request $request){

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
    
   

