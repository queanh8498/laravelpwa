<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\KhachHang;
use App\DonDatHang;
use App\HangHoa;
use App\ChiTietDatHang;
use App\User;
use App\BaoCaoCongNo;
use App\NhomHangHoa;

class DondathangController extends Controller
{
    public function xem_danhsachdondathang(){
        $danhsach_ddh = DB::select(
        'SELECT ddh.ddh_id, kh.kh_ten, nv.name, ddh.ddh_ngaylap, ddh.ddh_trangthai, ddh.ddh_giamchietkhau, ddh.ddh_congnocu, ddh.ddh_congnomoi, bccn.bccn_hanno, ddh.ddh_datra, SUM((ctdh.ctdh_soluong * ctdh.ctdh_dongia)-(ctdh.ctdh_soluong * ctdh.ctdh_dongia * ddh.ddh_giamchietkhau/100)) AS TongCong
        FROM dondathang ddh
        JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
        JOIN nhanvien nv ON ddh.id = nv.id
        JOIN khachhang kh ON ddh.kh_id = kh.kh_id
        LEFT JOIN baocaocongno bccn ON ddh.ddh_id = bccn.ddh_id
        GROUP BY ddh.ddh_id, kh.kh_ten, nv.name, ddh.ddh_ngaylap, ddh.ddh_trangthai, ddh.ddh_giamchietkhau, ddh.ddh_congnocu, ddh.ddh_congnomoi, bccn.bccn_hanno, ddh.ddh_datra');
        
        return view('dondathang.danhsach_ddh')
            ->with('danhsach_ddh', $danhsach_ddh);
    }

    public function chitietdondathang($ddh_id){
        $ddh = DB::select(
            'SELECT ddh.ddh_id, kh.kh_ten, kh.kh_sdt, nv.name, ddh.ddh_ngaylap, ddh.ddh_trangthai, ddh.ddh_congnocu, bccn.bccn_hanno
            FROM dondathang ddh
            LEFT JOIN baocaocongno bccn ON ddh.ddh_id = bccn.ddh_id
            JOIN nhanvien nv ON ddh.id = nv.id
            JOIN khachhang kh ON ddh.kh_id = kh.kh_id
            WHERE ddh.ddh_id = '.$ddh_id.'
            GROUP BY ddh.ddh_id, kh.kh_ten, kh.kh_sdt, nv.name, ddh.ddh_ngaylap, ddh.ddh_trangthai, ddh.ddh_congnocu, bccn.bccn_hanno');
          
        $ddh1 = DB::select(
            'SELECT ddh.ddh_id, hh.hh_id, hh.hh_ten, ctdh.ctdh_soluong, ctdh.ctdh_dongia, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia) AS TongTien, ddh.ddh_giamchietkhau, ddh.ddh_congnocu, ddh.ddh_congnomoi, SUM(ddh.ddh_congnocu + ddh.ddh_congnomoi) AS TongNo, bccn.bccn_hanno
            FROM dondathang ddh
            JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
            JOIN hanghoa hh ON ctdh.hh_id = hh.hh_id
            LEFT JOIN baocaocongno bccn ON ddh.ddh_id = bccn.ddh_id
            WHERE ddh.ddh_id='.$ddh_id.'
            GROUP BY ddh.ddh_id, hh.hh_id, hh.hh_ten, ctdh.ctdh_soluong, ctdh.ctdh_dongia, ddh.ddh_giamchietkhau, ddh.ddh_congnocu, ddh.ddh_congnomoi, bccn.bccn_hanno ');
        
        $ddh2 = DB::select(
            'SELECT aaa.TongSoLuong, aaa.TongTienHang, aaa.ddh_giamchietkhau, aaa.TongCong, aaa.ddh_datra ,sum(aaa.TongCong-aaa.ddh_datra) AS CongNoCanThu
            FROM (
            SELECT SUM(ctdh.ctdh_soluong) AS TongSoLuong, 
                    SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia) TongTienHang, 
                    SUM((ctdh.ctdh_soluong * ctdh.ctdh_dongia)-(ctdh.ctdh_soluong * ctdh.ctdh_dongia * ddh.ddh_giamchietkhau/100)) AS TongCong, ddh.ddh_giamchietkhau, ddh.ddh_datra
            FROM dondathang ddh
            JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
            JOIN hanghoa hh ON ctdh.hh_id = hh.hh_id
            WHERE ddh.ddh_id='.$ddh_id.'
            GROUP BY ddh.ddh_giamchietkhau, ddh.ddh_datra
            ) AS aaa
            GROUP BY aaa.TongSoLuong, aaa.TongTienHang, aaa.ddh_giamchietkhau, aaa.TongCong, aaa.ddh_datra ');
    
        return view('dondathang.chitiet_ddh')
            ->with('ddh', $ddh)
            ->with('ddh1', $ddh1)
            ->with('ddh2', $ddh2);       
    }
}
