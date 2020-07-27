<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\khachhang;
use App\dondathang;
use App\hanghoa;

session_start();

class KhachhangController extends Controller
{
   
    public function index()
    {
        $kh=DB::select('select kh.kh_id,kh.kh_ten,kh.kh_diachi,kh.kh_sdt, sum(ddh_congnomoi) as tongcongno  from khachhang as kh left join dondathang as ddh on kh.kh_id = ddh.kh_id group by kh.kh_id');
        //dd($kh);
        return view('khachhang.index')->with('kh',$kh);
    }
    public function getdetail($id){

        $chitiet_kh = DB::select('SELECT *,kh.kh_ten FROM dondathang dh 
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                WHERE dh.kh_id='.$id);
        
        return view('khachhang.chitiet')->with('chitiet_kh', $chitiet_kh);
    }

    public function create(){

        return view('khachhang.create');
    }
    
    public function store(Request $request){

        $validation = $request->validate([
            'kh_sdt' => 'unique:khachhang',
            'kh_ten' => 'required',
            'kh_diachi' => 'required'
        ]);

        $kh=new khachhang();
        $kh->kh_ten = $request->kh_ten;
        $kh->kh_sdt = $request->kh_sdt;
        $kh->kh_diachi = $request->kh_diachi;
        
        $kh->save();

        Session::flash('alert-success','Tạo khách hàng thành công');

        return redirect()->route('khachhang.index');
    }

    public function edit($id){

        $kh =khachhang::where("kh_id", $id)->first();
        //dd($kh);
        return view('khachhang.edit')->with('kh', $kh);
    }

    public function update(Request $request, $id)
    {
        $kh = khachhang::where('kh_id', $id)->first();

        $kh->kh_ten = $request->kh_ten;
        $kh->kh_sdt = $request->kh_sdt;
        $kh->kh_diachi = $request->kh_diachi;

        $kh->save();

        Session::flash('alert-info','Cập nhật thành công !');
        return redirect()->route('khachhang.index');
    }

}

