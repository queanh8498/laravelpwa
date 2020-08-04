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
use Barryvdh\DomPDF\Facade as PDF;
use Validator;
session_start();
use Carbon\Carbon;
use DateTime;
class PhieutrahangController extends Controller
{
       public function getdanhsach_pth(){
     $pth=phieutrahang::all();
      return view('kho.phieutrahang.danhsach_pth')->with('pth',$pth);
    }
   
    public function gettao_pth(){
      $kh=khachhang::all();

    	return view('kho.phieutrahang.tao_pth')->with('kh',$kh);
    }
    public function ddh($kh_id){

         if($kh_id!=0)
       {
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("Y-m-d");
        $ddh=dondathang::with('khachhang')->where('kh_id',$kh_id)->get();
        if(!$ddh->isEmpty()){
        
      foreach ($ddh as $dondathang) {      
      $b=$dondathang->ddh_ngaylap->addDays(7)->format("Y-m-d");
        if($b>$a){ 
       
        echo ' <input type="checkbox"  value="'.$dondathang->ddh_id.'">
         <label >DDH00'.$dondathang->ddh_id.'</label><br> ';
       }
      
      }
      }
      else{
        echo "<div style='color:red;'>Không có đơn hàng mới trong 7 ngày</div>";
      }
       
       }
        else{
  echo "<div style='color:red;'>Không có đơn hàng mới trong 7 ngày</div>";
      }


     }
 public function checkddh(Request $request){
   $ctddh= DB::table('chitietdathang')
   ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
   ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
   ->where([['chitietdathang.ddh_id',$request->ddh_id],['kh_id',$request->kh_id]])->get();
    $count = 0;
 $output='';
  $output .= "   <thead>
                <tr>
                      <th with='5%'></th>
                    <th with='15%'>Tên hàng hóa</th>
                    <th with='10%'>Số lượng</th>
                     <th with='10%'>Số lượng trả</th>
                      <th  with='10%' >Đơn giá</th>
                       <th   with='10%' >Thành tiền</th>
                    <th >Hành động</th>
                </tr>
               </thead>
               <tbody>";
  foreach ($ctddh as $key => $value) {
    $count++;
        $output .= "
             <tr>";
                $output .= "<td><input type='checkbox' name='check' class='check' id='check".$count."' value='".$count."'>
                <input type='hidden' name='ddh_id[]' class='form-control ddh_id' id='ddh_id".$count."' value='".$value->ddh_id."'  >
                </td>";
         $output .= "<td><input type='text' name='hh_ten[]' class='form-control hh_ten' id='hh_ten".$count."'  value='".$value->hh_ten."'  ></td> 
         <input type='hidden' name='hh_id[]' class='form-control hh_id' id='hh_id".$count."' data-sub_hh_id='".$count."' value='".$value->hh_id."'  >
         ";
         $output .= "
      
       <td><input type='text' name='ctdh_soluong[]' class='form-control ctdh_soluong' id='ctdh_soluong".$count."'  value='".$value->ctdh_soluong."' >
       </td> ";
        $output .= "
      
       <td><input type='text' name='ctth_soluong[]' class='form-control ctth_soluong' id='ctth_soluong".$count."'   >
       </td> ";

        $output .= "
     
       <td><input type='text' name='ctth_dongia[]' class='form-control ctth_dongia' id='ctth_dongia".$count."'  value='".$value->ctdh_dongia."'  ></td> ";
          $output .= "
     
       <td><input type='text' name='ctth_tt[]' class='form-control ctth_tt' id='ctth_tt".$count."'  value='0'   ></td> ";
          $output .= " <td></td></tr>";

      
       }
       $output.=" </tbody>
               <tfoot>
                  <tr>
                <td colspan='5' class='text-right' >  <strong>Tính tổng:</strong> </td>
                <td><input type='text' name='sum' id='sum' class='form-control' readonly='' value='0'></td>
                  <td></td>
              </tr>
                <tr>
                                <td colspan='6' align='right'>&nbsp;</td>
                                <td>
                   ".csrf_field()."
                  <input type='submit' name='save' id='save' class='btn btn-primary' value='Lưu'/>

                 </td>
                </tr>
               </tfoot>";
                $output.="";
        echo $output;
}
 
     
    
     function insertddh(Request $request)
    {
      if($request->ajax())
     {
      $rules = array(
       
       'ctdh_soluong.*'  => 'required'
      
      
      );
      $error = Validator::make($request->all(), $rules);
      if($error->fails())
      {
         
       return response()->json([
        'error'  => $error->errors()->all()
       ]);
        
      }
        $ddh_id=$request->ddh_id;
          for($count1 = 0; $count1 < count($ddh_id); $count1++)
      {
       $value= $ddh_id[$count1];
      }
    
      $pth =new phieutrahang;
    
      $pth->ddh_id=$value;
      $pth->id=$request->nv_id;
      date_default_timezone_set('Asia/Ho_Chi_Minh');
      $pth->pth_ngaylap = now();
      $pth->pth_trangthai=1;
      $pth->save();
       $hh_id = $request->hh_id;
      $ctth_soluong = $request->ctth_soluong;
      $ctth_dongia=$request->ctth_dongia;
   for($count = 0; $count < count($hh_id); $count++)
      {
       $data = array(
        'pth_id' => $pth->pth_id,
        'hh_id' => $hh_id[$count],
        'ctth_soluong'  => $ctth_soluong[$count],
        'ctth_dongia'  => $ctth_dongia[$count]
       );
       $insert_data[] = $data; 
      }
      
      chitiettrahang::insert($insert_data);
      return response()->json([
       'success'  => 'Phiếu khách trả hàng được tạo thành công.'
      ]);
     
     }
    }
     
      public function getchitiet_pth($pth_id){
    $pth=phieutrahang::find($pth_id);
   $ctth=DB::table('chitiettrahang')
     ->join('hanghoa','hanghoa.hh_id','=','chitiettrahang.hh_id')
     ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
    ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
   ->where('chitiettrahang.pth_id',$pth_id)->get();
    return view('kho.phieutrahang.chitiet_pth')->with('pth',$pth)->with('ctth',$ctth);

    }
        function timsdt_khpth(Request $request){
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

         public function pdf_pth($pth_id) 
{
   $pth = phieutrahang::find($pth_id);
      $ctth=DB::table('chitiettrahang')
     ->join('hanghoa','hanghoa.hh_id','=','chitiettrahang.hh_id')
     ->join('nhomhanghoa','hanghoa.nhom_id','=','nhomhanghoa.nhom_id')
    ->join('nhacungcap','nhacungcap.ncc_id','=','nhomhanghoa.ncc_id')
   ->where('chitiettrahang.pth_id',$pth_id)->get();
    $data = [
        'pth' => $pth,
        'ctth'  => $ctth,
    ];

   
    /* Code dành cho việc debug
    - Khi debug cần hiển thị view để xem trước khi Export PDF
    */
    // return view('backend.sanpham.pdf')
    //     ->with('danhsachsanpham', $ds_sanpham)
    //     ->with('danhsachloai', $ds_loai);
     $pdf = PDF::loadView('kho.phieutrahang.pdf_pth',$data);
     return $pdf->stream();
}
    
}
