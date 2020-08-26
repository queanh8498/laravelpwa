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
use App\dondathang;
use App\khachhang;
use App\baocaocongno;

class ThongkeController extends Controller
{
    public function thongke()
    {
        // $thongke = DB::select(
        //     'SELECT COUNT(*) AS sodonhang, sum(bccn.bccn_soducongno) AS TongCongNo, SUM(ddh.ddh_datra) AS TongTienThuDuoc
        //     FROM dondathang ddh
        //     JOIN baocaocongno bccn ON bccn.ddh_id = ddh.ddh_id
        //     WHERE month(ddh.ddh_ngaylap)=MONTH(NOW())');

        //thống kê tổng đơn hàng trong tháng hiện tại
        $sumdonhang=DB::select(
            'SELECT COUNT(*) AS sodonhang
            FROM dondathang ddh
            WHERE month(ddh.ddh_ngaylap)=MONTH(NOW())');

        //tổng tiền khách đã trả
        $sumkhachtra_month_now=DB::select(
            'SELECT SUM(ddh.ddh_datra) AS tienkhachtra
            FROM dondathang ddh
            WHERE month(ddh.ddh_ngaylap)=MONTH(NOW())');

        //tổng tiền thu trong tháng hiện tại
        $sumtienthu_month_now=DB::select(
            'SELECT SUM(pt.pt_tienthu) AS tongtienthu
            FROM phieuthu pt
            WHERE month(pt.pt_ngaylap)=MONTH(NOW())');

        //tổng tiền trả hàng trong tháng hiện tại
        $sumtrahang_month_now=DB::select(
            'SELECT SUM(tth.TienTraKhach) AS TongTienTraKhach
            FROM 
                (SELECT ddh.ddh_id, pth.pth_id, pth.pth_ngaylap ,SUM(pth.pth_ctk) AS TienTraKhach
                FROM dondathang ddh
                JOIN phieutrahang pth ON pth.ddh_id = ddh.ddh_id
                JOIN chitiettrahang ctth ON ctth.pth_id = pth.pth_id
                WHERE month(pth.pth_ngaylap)=MONTH(NOW())
                GROUP BY ddh.ddh_id, pth.pth_id) AS tth');

        //tổng tiền nợ all các đơn hàng trong tháng hiện tại
        $sumtienno_month_now=DB::select(
            'SELECT SUM(bccn.bccn_soducongno) AS tienno
            FROM dondathang ddh
            JOIN baocaocongno bccn ON ddh.ddh_id = bccn.ddh_id
            WHERE month(ddh.ddh_ngaylap)=MONTH(NOW())');

        foreach($sumdonhang as $sumdonhang){
            $sodonhang = $sumdonhang->sodonhang;
        }
        foreach($sumkhachtra_month_now as $sumkhachtra_month_now){
            $a = $sumkhachtra_month_now->tienkhachtra;
        }
        foreach($sumtienthu_month_now as $sumtienthu_month_now){
            $b = $sumtienthu_month_now->tongtienthu;
        }
        foreach($sumtrahang_month_now as $sumtrahang_month_now){
            $c = $sumtrahang_month_now->TongTienTraKhach;
        }
        foreach($sumtienno_month_now as $sumtienno_month_now){
            $tienno = $sumtienno_month_now->tienno;
        }

        $a_b_c = $a + $b - $c;
        $tongno = $tienno - $b;
        //dd($a_b_c);
        // echo $a_b_c;
        // die;

        //lấy ngày hiện tại -> format lại
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("Y-m-d");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(5);
        $b = $current_day_add;
        $current_day_add=$b->format("Y-m-d");


        return view('thongke.thongke')
            //    -> with('thongke', $thongke)
               ->with('current_day', $current_day)
               ->with('current_day_add', $current_day_add)
               ->with('a_b_c', $a_b_c)
               ->with('sodonhang', $sodonhang)
               ->with('tongno', $tongno);
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
        $from_date_1 = date('Y-m-d', strtotime($from_date));
        
        $to_date = $request->input('to_date');
        //vd: chọn 22/7 -> 27/7 kết quả chỉ lấy từ 22/7 -> 26/7 ==> nên phải cộng 1 day.
        // $to_date_1 = date('Y-m-d', strtotime($to_date. ' + 1 days'));
        $to_date_1 = date('Y-m-d', strtotime($to_date));
        //dd($to_date_1);

        //lấy ngày hiện tại -> format lại
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("Y-m-d");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(5);
        $b = $current_day_add;
        $current_day_add=$b->format("Y-m-d");

        // $sodonhang_timkiem = DB::select(
        //     'SELECT COUNT(*) AS sodonhang, sum(bccn.bccn_soducongno) AS TongCongNo, SUM(ddh.ddh_datra) AS TongTienThuDuoc
        //     FROM dondathang ddh
        //     JOIN baocaocongno bccn ON bccn.ddh_id = ddh.ddh_id
        //     WHERE ddh.ddh_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'"');

        //thống kê số đơn hàng theo thời gian chọn
        $sodonhang_timkiem = DB::select(
            'SELECT COUNT(*) AS sodonhang
            FROM dondathang ddh
            WHERE ddh.ddh_ngaylap BETWEEN "'.$from_date_1.'" AND "'.$to_date_1.'"');
        //dd($sodonhang_timkiem);
        
        //thống kê tổng tiền khách trả theo thời gian chọn
        $sumkhachtra_timkiem = DB::select(
            'SELECT SUM(ddh.ddh_datra) AS tienkhachtra
            FROM dondathang ddh
            WHERE ddh.ddh_ngaylap BETWEEN "'.$from_date_1.'" AND "'.$to_date_1.'"');

        //thống kê tổng tiền thu theo thời gian chọn
        $sumtienthu_timkiem = DB::select(
            'SELECT SUM(pt.pt_tienthu) AS tongtienthu
            FROM phieuthu pt
            WHERE pt.pt_ngaylap BETWEEN "'.$from_date_1.'" AND "'.$to_date_1.'"');

        //thống kê tổng tiền khách trả hàng theo thời gian chọn
        $sumtrahang_timkiem = DB::select(
            'SELECT SUM(tth.TienTraKhach) AS TongTienTraKhach
            FROM 
                (SELECT ddh.ddh_id, pth.pth_id, pth.pth_ngaylap ,SUM(pth.pth_ctk) AS TienTraKhach
                FROM dondathang ddh
                JOIN phieutrahang pth ON pth.ddh_id = ddh.ddh_id
                JOIN chitiettrahang ctth ON ctth.pth_id = pth.pth_id
                WHERE pth.pth_ngaylap BETWEEN "'.$from_date_1.'" AND "'.$to_date_1.'"
                GROUP BY ddh.ddh_id, pth.pth_id) AS tth;');

        //tổng tiền nợ all các đơn hàng theo thời gian chọn
        $sumtienno_timkiem=DB::select(
            'SELECT SUM(bccn.bccn_soducongno) AS tienno
            FROM dondathang ddh
            JOIN baocaocongno bccn ON ddh.ddh_id = bccn.ddh_id
            WHERE ddh.ddh_ngaylap BETWEEN "'.$from_date_1.'" AND "'.$to_date_1.'"');
        

        foreach($sodonhang_timkiem as $sodonhang_timkiem){
            $sodonhang = $sodonhang_timkiem->sodonhang;
        }
        foreach($sumkhachtra_timkiem as $sumkhachtra_timkiem){
            $a = $sumkhachtra_timkiem->tienkhachtra;
        }
        foreach($sumtienthu_timkiem as $sumtienthu_timkiem){
            $b = $sumtienthu_timkiem->tongtienthu;
        }
        foreach($sumtrahang_timkiem as $sumtrahang_timkiem){
            $c = $sumtrahang_timkiem->TongTienTraKhach;
        }
        foreach($sumtienno_timkiem as $sumtienno_timkiem){
            $tienno = $sumtienno_timkiem->tienno;
        }

        $a_b_c = $a + $b - $c;
        $tongno = $tienno - $b;
        //echo $tienno;
        //echo $b;
        //die;
        
        return view('thongke.timkiem')
        // ->with('thongke_timkiem', $thongke_timkiem)
        ->with('sodonhang', $sodonhang)
        ->with('a_b_c', $a_b_c)
        ->with('tongno', $tongno)
        ->with('current_day', $current_day)
        ->with('current_day_add', $current_day_add)
        ->with('from_date', $from_date)
        ->with('to_date', $to_date)
        ->with('thongbao','Thành công');
    }
}
