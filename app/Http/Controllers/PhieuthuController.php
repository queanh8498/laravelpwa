<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\khachhang;
use App\congno_khachhang;
use App\phieuthu;
use App\User;
use DB;
use Validator;


session_start();
use Carbon\Carbon;

class PhieuthuController extends Controller
{
    public function index(){
        $pt=DB::select('SELECT pt.pt_id,pt.pt_ngaylap,kh.kh_ten,pt_tienthu,cn.tongno,pt.id,nv.name FROM phieuthu pt 
        JOIN khachhang kh ON kh.kh_id=pt.kh_id 
        join nhanvien nv on nv.id = pt.id
        JOIN congno_khachhang cn ON cn.kh_id=pt.kh_id ');

        return view('khachhang.phieuthu.index')->with('pt',$pt);
       }

    public function create(){

        $nv = user::all();
        return view('khachhang.phieuthu.create')->with('nv',$nv);
    }
    function timsdt_kh(Request $request){
        if($request->ajax()){
            $output = '';
            $output1 = '';
            $output2 = '';
            $query = $request->get('query');
            if($query != ''){
                 $data = DB::table('khachhang')
                    ->select('khachhang.kh_ten', 'khachhang.kh_id', DB::raw('congno_khachhang.tongno as congnocu'))
                    ->leftJoin('congno_khachhang', 'congno_khachhang.kh_id', '=', 'khachhang.kh_id')
                    ->where('khachhang.kh_sdt', 'like', '%'.$query.'%')
                    ->get();
            }
     
            $total_row = $data->count();

            if($total_row > 0){
                foreach($data as $row){
                    $output .= $row->kh_ten;
                    $output1 .= $row->kh_id;
                    if(empty($row->congnocu)){
                        $output2 .= 0;
                    }
					else
					{
						$output2 .= $row->congnocu;
                    }
                }
            }
            else{
                $output = 'Không tìm thấy';
            }

            $data = array(
                //'table_data'  => $output,
                'kh_ten' => $output,
                'kh_id' => $output1,
                'congnocu' => $output2,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }
    function insert(Request $request){
        if($request->ajax()){
            $rules = array(
                'kh_sdt'=>'required',
                'pt_tienthu'  => 'required',
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails()){
                return response()->json([
                'error'  => $error->errors()->all()
                ]); 
            }
            //luu phieu thu
            $pt = new phieuthu();
            $pt->kh_id=$request->kh_id;
            $pt->pt_tienthu=$request->pt_tienthu;
            $pt->pt_ngaylap=Carbon::now('Asia/Ho_Chi_Minh');
            $pt->save();
            
            //cập nhật nợ hiện tại = tongno - tienthu
             $cnkh=congno_khachhang::select('cnkh_id','kh_id','tongno')->where('kh_id',$pt->kh_id)->first();
             if(!empty($cnkh)){
                 $cnkh->kh_id = $request->kh_id;
                 $cnkh->tongno -= $request->pt_tienthu;
                 $cnkh->save();
             }
            
            return response()->json([
                'success'  => 'Phiếu thu được tạo thành công.'
            ]);
        }
    }
}
