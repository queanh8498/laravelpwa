<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Dondathang;
use App\Khachhang;
use App\Baocaocongno;

class ThongkeController extends Controller
{
    public function thongke()
    {
        $khachhang_count = Khachhang::count();
        $donhang_count = Dondathang::count();
        $tongtienthuduoc = DB::table('dondathang')->select( DB::raw('SUM(ddh_datra) as TongTienThuDuoc'))->first();
        $tongno = DB::table('baocaocongno')->select( DB::raw('SUM(bccn_soducongno) as TongNo'))->first();
        return view('thongke.thongke')
            ->with('khachhang_count', $khachhang_count)
            ->with('donhang_count',$donhang_count)
            ->with('tongtienthuduoc', $tongtienthuduoc)
            ->with('tongno', $tongno);
    }
}
