<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Barryvdh\DomPDF\Facade as PDF;
use App\KhachHang;
use App\DonDatHang;
use App\HangHoa;
use App\ChiTietDatHang;
use App\ChiTietPhieuXuat;
use App\User;
use App\BaoCaoCongNo;
use App\NhomHangHoa;
use App\PhieuXuatKho;
use App\KhoHang;
use App\NhaCungCap;
use Validator;
use Carbon\Carbon;
use Session;

session_start();

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
            'SELECT aaa.TongSoLuong, aaa.TongTienHang, aaa.ddh_giamchietkhau, aaa.TongCong, aaa.ddh_datra ,sum(aaa.TongCong+aaa.ddh_congnocu-aaa.ddh_datra) AS ConLai
            FROM (
                    SELECT SUM(ctdh.ctdh_soluong) AS TongSoLuong, 
                          SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia) TongTienHang, 
                          SUM((ctdh.ctdh_soluong * ctdh.ctdh_dongia)-(ctdh.ctdh_soluong * ctdh.ctdh_dongia * ddh.ddh_giamchietkhau/100)) AS TongCong, ddh.ddh_giamchietkhau, ddh.ddh_datra, ddh.ddh_congnocu
                    FROM dondathang ddh
                    JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
                    JOIN hanghoa hh ON ctdh.hh_id = hh.hh_id
                    WHERE ddh.ddh_id='.$ddh_id.'
                    GROUP BY ddh.ddh_giamchietkhau, ddh.ddh_datra, ddh.ddh_congnocu
                ) AS aaa
            GROUP BY aaa.TongSoLuong, aaa.TongTienHang, aaa.ddh_giamchietkhau, aaa.TongCong, aaa.ddh_datra ');
    
        return view('dondathang.chitiet_ddh')
            ->with('ddh', $ddh)
            ->with('ddh1', $ddh1)
            ->with('ddh2', $ddh2);       
    }
    public function tao_dondathang(){
        $khachhang = KhachHang::all();
        $nhanvien = User::all();
        $nhom=nhomhanghoa::all();

        return view('dondathang.tao_ddh')
            ->with('khachhang', $khachhang)
            ->with('nhanvien', $nhanvien)
            ->with('nhom', $nhom);
    }

    public function dongia(Request $request){
  
        //it will get price if its id match with product id
        $p=hanghoa::select('hh_dongia')->where('hh_id',$request->id)->first();
        
        return response()->json($p);
    }

    public function hanghoa(Request $request){
    //if our chosen id and products table prod_cat_id col match the get first 100 data 

    //$request->id here is the id of our chosen option id
    $data=hanghoa::select('hh_ten','hh_id')->where([['nhom_id',$request->id]])->get();
    
        $output = '';
    
        $output = ' <option value="">--Chọn hàng hóa--</option>';
        
        foreach($data as $key => $value){
                $output.='<option value="'.$value->hh_id.'">'.$value->hh_ten.'</option>';
        }
        echo $output;       
    }

    function insert(Request $request){
        if($request->ajax()){
            $rules = array(
                'nhom_id.*'=>'required',
                'hh_id.*'=>'required',
                'ctdh_soluong.*'  => 'required'
            );

            $error = Validator::make($request->all(), $rules);

            if($error->fails()){
                return response()->json([
                'error'  => $error->errors()->all()
                ]); 
            }
            
            //$checkout_code = substr(md5(microtime()),rand(0,26),5);
            $ddh = new dondathang();
            $ddh->ddh_id=$request->ddh_id;
            $ddh->id=$request->id;
            $ddh->kh_id=$request->kh_id;
            //dd($ddh->kh_id);
            //date_default_timezone_set('Asia/Ho_Chi_Minh');
            $ddh->ddh_ngaylap = Carbon::now('Asia/Ho_Chi_Minh');
            $ddh->ddh_trangthai = 1;
            $ddh->ddh_giamchietkhau = $request->ddh_giamchietkhau;
            $ddh->ddh_congnocu = $request->ddh_congnocu;
            $ddh->ddh_congnomoi =$request->ddh_congnomoi;
            $ddh->ddh_datra = $request->ddh_datra;
            $ddh->save();
            
            $bccn = new baocaocongno();
            $bccn->ddh_id=$ddh->ddh_id;
            $bccn->bccn_hanno = date('Y-m-d', strtotime($request->ddh_ngaylap. ' + 30 days'));
            $bccn->bccn_soducongno = $request->ddh_congnomoi;
            $bccn->save();

            $hh_id = $request->hh_id;
            $ctdh_soluong = $request->ctdh_soluong;
            $ctdh_dongia=$request->ctdh_dongia;

            //lay kho theo hang hoa
            $get_kho= DB::table('hanghoa')
                ->select('hanghoa.hh_id', 'hanghoa.kho_id as kho_id')
                ->join('khohang', 'khohang.kho_id', '=', 'hanghoa.kho_id')
                ->where('hanghoa.hh_id', $hh_id)
                ->first();    
            //them vô kho 
            $pxk = new phieuxuatkho();
            $pxk->pxk_id=$request->pxk_id;
            $pxk->kho_id = $get_kho->kho_id;
            $pxk->id = $request->id;
            $pxk->pxk_ngayxuatkho = Carbon::now('Asia/Ho_Chi_Minh');
            $pxk->ddh_id=$ddh->ddh_id;
            $pxk->save();
           
            for($count1 = 0; $count1 < count($hh_id); $count1++){
                $product= DB::table('hanghoa')->where('hh_id',$hh_id[$count1])->get();
                foreach ($product as $key => $value){
                    $value1=$value->hh_soluong+$ctdh_soluong[$count1];
                    $data1 = array();
                    $data1['hh_soluong'] =$value1;
                    DB::table('hanghoa')->where('hh_id',$hh_id[$count1] )->update($data1); 
                }
            }

            for($count = 0; $count < count($hh_id); $count++){
                $data = array(
                    'ddh_id'=> $ddh->ddh_id,
                    'hh_id' => $hh_id[$count],
                    'ctdh_soluong'  => $ctdh_soluong[$count],
                    'ctdh_dongia'  => $ctdh_dongia[$count]
                );
                $insert_data[] = $data; 
            }
            ChiTietDatHang::insert($insert_data);

            //them vao chitietphieuxuat
            for($count2 = 0; $count2 < count($hh_id); $count2++){
                $data2 = array(
                    'pxk_id'=>  $pxk->pxk_id,
                    'hh_id' => $hh_id[$count2],
                    'ctpx_soluong'  => $ctdh_soluong[$count2],
                    'ctpx_dongia'  => $ctdh_dongia[$count2]
                );
                $insert_data2[] = $data2; 
            }
            ChiTietPhieuXuat::insert($insert_data2);

            return response()->json([
                'success'  => 'Đơn hàng được tạo thành công.'
            ]);
        }
    }

    function timsdt_kh(Request $request){
        if($request->ajax()){
            $output = '';
            $output1 = '';
            $output2 = '';
            $query = $request->get('query');
            if($query != ''){
                $data = DB::table('khachhang')
                    ->select('khachhang.kh_ten', 'khachhang.kh_id', DB::raw('SUM(dondathang.ddh_congnomoi) as ddh_congnocu'))
                    ->leftJoin('dondathang', 'dondathang.kh_id', '=', 'khachhang.kh_id')
                    ->where('kh_sdt', 'like', '%'.$query.'%')
                    ->get();
            }
     
            $total_row = $data->count();

            if($total_row > 0){
                foreach($data as $row){
                    $output .= $row->kh_ten;
                    $output1 .= $row->kh_id;
                    if(empty($row->ddh_congnocu)){
                        $output2 .= 0;
                    }
					else
					{
						$output2 .= $row->ddh_congnocu;
                    }
                }
            }
            else{
                $output =
                '<tr>
                    <td align="center" colspan="5">No Data Found</td>
                </tr>';
            }

            $data = array(
                //'table_data'  => $output,
                'kh_ten' => $output,
                'kh_id' => $output1,
                'ddh_congnocu' => $output2,
                'total_data'  => $total_row
            );

            echo json_encode($data);
        }
    }

    public function pdf_ddh($ddh_id) {
        $ddh = dondathang::find($ddh_id);
        $ctdh=DB::table('chitietdathang')
            ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
            ->where('chitietdathang.ddh_id',$ddh_id)->get();
        $ddh2 = DB::select(
            'SELECT bbb.TongCong, bbb.ddh_congnocu, bbb.ddh_datra, SUM((bbb.TongCong+bbb.ddh_congnocu-bbb.ddh_datra)) AS ConLai
            FROM(
                SELECT  SUM((ctdh.ctdh_soluong * ctdh.ctdh_dongia)-(ctdh.ctdh_soluong * ctdh.ctdh_dongia * ddh.ddh_giamchietkhau/100)) AS TongCong ,ddh.ddh_datra, ddh.ddh_congnocu
                FROM dondathang ddh
                JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
                JOIN hanghoa hh ON ctdh.hh_id = hh.hh_id
                WHERE ddh.ddh_id='.$ddh_id.'
                GROUP BY ddh.ddh_datra, ddh.ddh_congnocu) AS bbb
                GROUP BY bbb.TongCong, bbb.ddh_congnocu, bbb.ddh_datra');
        $ddh3 = DB::select(
            'SELECT SUM(ccc.TongTien * ccc.ddh_giamchietkhau/100) AS TienGiamChietKhau
            FROM(
            SELECT SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia) AS TongTien, ddh.ddh_giamchietkhau
            FROM dondathang ddh
            JOIN chitietdathang ctdh ON ctdh.ddh_id = ddh.ddh_id
            JOIN hanghoa hh ON ctdh.hh_id = hh.hh_id
            WHERE ddh.ddh_id='.$ddh_id.') AS ccc');

        $data = [
            'ddh' => $ddh,
            'ctdh' => $ctdh,
            'ddh2' => $ddh2,
            'ddh3' => $ddh3,
        ];
        $pdf = PDF::loadView('dondathang.pdf_ddh',$data);
        return $pdf->stream();
    }

    public function pdf_pxk($ddh_id) {
        $ddh = dondathang::find($ddh_id);
        // $pxk = DB::table('dondathang')
        //     ->select('phieuxuatkho.pxk_id', 'phieuxuatkho.pxk_ngayxuatkho', 'khachhang.kh_ten', 'khachhang.kh_diachi' )
        //     ->join('khachhang', 'khachhang.kh_id', '=', 'dondathang.kh_id')
        //     ->join('phieuxuatkho', 'phieuxuatkho.ddh_id', '=', 'dondathang.ddh_id')
        //     ->join('chitietphieuxuat', 'chitietphieuxuat.pxk_id', '=', 'phieuxuatkho.pxk_id')
        //     ->join('hanghoa', 'hanghoa.hh_id', '=', 'chitietphieuxuat.hh_id')
        //     ->where('phieuxuatkho.ddh_id',$ddh_id)->get();
        $pxk= DB::table('khachhang')->select('khachhang.kh_ten', 'khachhang.kh_diachi','khachhang.kh_sdt', 'dondathang.ddh_ngaylap')
            ->join('dondathang', 'dondathang.kh_id', '=', 'khachhang.kh_id')
            ->where('dondathang.ddh_id', $ddh_id)
            ->first();

        $chitiet_pxk = DB::select(
            'SELECT *
            FROM dondathang ddh
            JOIN phieuxuatkho pxk ON pxk.ddh_id = ddh.ddh_id
            JOIN chitietphieuxuat ctpx ON ctpx.pxk_id = pxk.pxk_id
            JOIN hanghoa hh on ctpx.hh_id = hh.hh_id
            WHERE pxk.ddh_id='.$ddh_id.'');

        $ddh3 = DB::select(
            'SELECT SUM(ccc.TongTien * ccc.ddh_giamchietkhau/100) AS TienGiamChietKhau
            FROM(
                SELECT SUM(ctpx.ctpx_soluong * ctpx.ctpx_dongia) AS TongTien, ddh.ddh_giamchietkhau
                FROM dondathang ddh
                JOIN phieuxuatkho pxk ON pxk.ddh_id = ddh.ddh_id
                JOIN chitietphieuxuat ctpx ON ctpx.pxk_id = pxk.pxk_id
                JOIN hanghoa hh on ctpx.hh_id = hh.hh_id
                WHERE ddh.ddh_id='.$ddh_id.'
            ) AS ccc');
        $data = [
            'ddh' => $ddh, 
            'pxk' => $pxk, 
            'chitiet_pxk' => $chitiet_pxk,
            'ddh3' => $ddh3,
        ];
        $pdf = PDF::loadView('dondathang.pdf_pxk',$data);
        return $pdf->stream();
    }

	public function store_kh_moi(Request $request)
    {
        $validation = $request->validate([
            'kh_sdt_' => 'unique:khachhang',
            'kh_ten_' => 'required',
            'kh_diachi_' => 'required',
            'kh_sdt_' => 'required',
        ],
        [
            'kh_sdt_.unique'=>'Số diện thoại này đã tồn tại',
            'kh_ten_.required'=>'Vui lòng nhập họ tên khách hàng',
            'kh_diachi_.required'=>'Vui lòng nhập địa chỉ khách hàng',
            'kh_sdt_.required'=>'Vui lòng nhập số điện thoại'
        ]
    );

        $kh = new khachhang();
        $kh->kh_ten = $request->kh_ten_;
        $kh->kh_sdt = $request->kh_sdt_;
        $kh->kh_diachi = $request->kh_diachi_;
        
        $kh->save();

        Session::flash('alert-success','Tạo khách hàng thành công');

        return redirect()->route('taodondathang');
    }


    public function pdf_phieukynhan($ddh_id) {
        $ddh = dondathang::find($ddh_id);

        //chi tiet thong tin khách hàng của đơn hàng đó 
        $chitiet_kh= DB::table('khachhang')->select('khachhang.kh_ten', 'khachhang.kh_diachi','khachhang.kh_sdt')
        ->join('dondathang', 'dondathang.kh_id', '=', 'khachhang.kh_id')
        ->where('dondathang.ddh_id', $ddh_id)
        ->first();   

        //'SELECT *, ct.ctdh_soluong * ct.ctdh_dongia - ct.ctdh_soluong * ct.ctdh_dongia * dh.ddh_giamchietkhau/100 AS tongtien

        $chitiet_ddh = DB::select(
            'SELECT *, ct.ctdh_soluong * ct.ctdh_dongia AS tongtien
            FROM dondathang dh 
            JOIN chitietdathang ct on dh.ddh_id=ct.ddh_id
            JOIN hanghoa hh ON hh.hh_id=ct.hh_id
            WHERE dh.ddh_id='.$ddh_id);

        $data = [
            'ddh' => $ddh,
            'chitiet_kh' => $chitiet_kh,
            'chitiet_ddh' => $chitiet_ddh,          
        ];
        $pdf = PDF::loadView('dondathang.pdf_phieukynhan',$data);
        return $pdf->stream();
    }
}
