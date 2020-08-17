<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Carbon\Carbon;
use Datetime;
use Session;
use App\Dondathang;
use App\Khachhang;
use App\Baocaocongno;

class ThongkeController extends Controller
{
    public function thongke()
    {
        $thongke = DB::select(
            'SELECT COUNT(*) AS sodonhang, sum(bccn.bccn_soducongno) AS TongCongNo, SUM(ddh.ddh_datra) AS TongTienThuDuoc
            FROM dondathang ddh
            JOIN baocaocongno bccn ON bccn.ddh_id = ddh.ddh_id
            WHERE month(ddh.ddh_ngaylap)=MONTH(NOW())');

        //lấy ngày hiện tại -> format lại
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("Y-m-d");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(5);
        $b = $current_day_add;
        $current_day_add=$b->format("Y-m-d");


        return view('thongke.thongke')
               -> with('thongke', $thongke)
               ->with('current_day', $current_day)
               ->with('current_day_add', $current_day_add);
    }
    public function thongke_timkiem(Request $request){
        $this->validate($request,[
            'from_date'=> 'required',
            'to_date'=>'required'
        ],
        [
            'from_date.required'=>'Bạn chưa nhập ngày bắt đầu',
            'to_date.required'=>'Bạn chưa nhập ngày kết thúc'
        ]);
        //******search from date to date
        $from_date = $request->input('from_date');
        $to_date = $request->input('to_date');

        //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
        $to_date_1 = date('Y-m-d', strtotime($to_date. ' + 1 days'));
        //dd($to_date_1);

        //lấy ngày hiện tại -> format lại
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("Y-m-d");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(5);
        $b = $current_day_add;
        $current_day_add=$b->format("Y-m-d");

        $thongke_timkiem = DB::select(
            'SELECT COUNT(*) AS sodonhang, sum(bccn.bccn_soducongno) AS TongCongNo, SUM(ddh.ddh_datra) AS TongTienThuDuoc
            FROM dondathang ddh
            JOIN baocaocongno bccn ON bccn.ddh_id = ddh.ddh_id
            WHERE ddh.ddh_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'"');
        // dd($chitiet_kh_date);

        return view('thongke.timkiem')
        ->with('thongke_timkiem', $thongke_timkiem)
        ->with('current_day', $current_day)
        ->with('current_day_add', $current_day_add)
        ->with('from_date', $from_date)
        ->with('to_date', $to_date)
        ->with('thongbao','Thành công');
    }
}
