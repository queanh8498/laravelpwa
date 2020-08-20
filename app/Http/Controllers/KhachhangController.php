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
use App\phieuthu;
use Carbon\Carbon;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;

use App\Exports\Congno_Khachhang_Export;
use App\Exports\Congno_KH_Time_Export;
use Maatwebsite\Excel\Facades\Excel;
  
session_start();

class KhachhangController extends Controller
{
   
    public function index()
    {
        $kh=DB::select('select kh.kh_id,kh.kh_ten,kh.kh_diachi,kh.kh_sdt, 
        cn.tongno as tongcongno  from khachhang as kh 
        join congno_khachhang as cn on kh.kh_id = cn.kh_id group by kh.kh_id');
        //dd($kh);
        return view('khachhang.index')->with('kh',$kh);
    }
    public function getdetail($id){

        // $chitiet_kh = DB::select('SELECT *,kh.kh_ten, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien 
        //                         FROM dondathang dh 
        //                         JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
        //                         join khachhang kh on kh.kh_id = dh.kh_id
        //                         JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        //                         WHERE dh.kh_id='.$id.'
        //                          GROUP BY dh.ddh_id');
                                // dd($chitiet_kh);
                        $chitiet_kh = DB::select('SELECT *,kh.kh_ten, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
                                FROM dondathang dh 
                                JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                left join 
                                        (select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
                                          join chitiettrahang ctth on pth.pth_id = ctth.pth_id
                                          join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id ) as aaa on dh.ddh_id = aaa.donhang_id
                                WHERE dh.kh_id='.$id.' GROUP BY dh.ddh_id');

        $dathu_tongno_kh = DB::select('SELECT kh.kh_id,kh.kh_ten,pt_id,pt_ngaylap,pt_tienthu, SUM(pt.pt_tienthu) as tongthu_kh,tongno 
                                        from khachhang kh 
                                        left join phieuthu pt on pt.kh_id=kh.kh_id 
                                        left join congno_khachhang cn on cn.kh_id=kh.kh_id
                                        where kh.kh_id='.$id);


        $chitiet_thu=DB::select('SELECT kh.kh_id,kh.kh_ten, pt_id,pt_ngaylap,pt_tienthu
        from khachhang kh 
        join phieuthu pt on pt.kh_id=kh.kh_id 
        where kh.kh_id='.$id);
        //dd($dathu_tongno_kh);

		// now+5 >= hanno;
       // 11/1 + 5 => 20/1 => sap toi han ;
    /************************** */
    //    if now < hanno {
    //     if (now+5 >= hanno)
    //         =>saptoihan;
    //     }
    //      }elseif (now = hanno){
    //     ==>toi han;
    // }
    //else{ 
    //     ==>qua han;
    // }
		//lấy ngày hiện tại -> format lại
        $current_day = Carbon::now('Asia/Ho_Chi_Minh');
        $a = $current_day;
        $current_day=$a->format("d-m-Y");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(6);//=>ngày 11 thêm 5 ngày ra ngày 16 => add 6 days
        $b = $current_day_add;
        $current_day_add=$b->format("d-m-Y");
		
       //sau khi format thì đã có thể so sánh được
        //  if( $current_day < $current_day_add){ $t = 1; }
        //  dd($t); 

        //TỚI HẠN LÀ CÓ BCCN_TOIHAN = NOW()
        $dh_toihan = DB::select('SELECT *, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM baocaocongno bc JOIN dondathang dh ON dh.ddh_id=bc.ddh_id
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        left join 
(select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
 join chitiettrahang ctth on pth.pth_id = ctth.pth_id
 join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id      
WHERE dh.kh_id='.$id.' AND date(bc.bccn_hanno) = CURDATE()');
        
        //QUÁ HẠN LÀ CÓ BCCN_TOIHAN < NOW()
        $dh_quahan = DB::select('SELECT *, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM baocaocongno bc JOIN dondathang dh ON dh.ddh_id=bc.ddh_id
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        left join 
(select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
 join chitiettrahang ctth on pth.pth_id = ctth.pth_id
 join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id                  
WHERE dh.kh_id='.$id.' AND date(bc.bccn_hanno) < CURDATE() and dh.ddh_congnomoi <>0 ');

        //Sắp tới HẠN LÀ CÓ (bccn_toihan > now) and ( NOW() + 5 > BCCN_TOIHAN )
        $dh_saptoihan = DB::select('SELECT *, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM baocaocongno bc JOIN dondathang dh ON dh.ddh_id=bc.ddh_id
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        left join 
(select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
 join chitiettrahang ctth on pth.pth_id = ctth.pth_id
 join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id                                  
      WHERE dh.kh_id='.$id.' AND date(bc.bccn_hanno) > CURDATE() 
      AND adddate(CURDATE(),INTERVAL 6 DAY) > DATE(bc.bccn_hanno)
      ');

        //Lọc ĐH đã trả
        $dh_datra = DB::select('SELECT *, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM baocaocongno bc JOIN dondathang dh ON dh.ddh_id=bc.ddh_id
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        left join 
(select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
 join chitiettrahang ctth on pth.pth_id = ctth.pth_id
 join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id
        WHERE dh.kh_id='.$id.' AND dh.ddh_congnomoi=0');

        return view('khachhang.chitiet')
        ->with('chitiet_kh', $chitiet_kh)
        ->with('current_day', $current_day)
        ->with('current_day_add', $current_day_add)
        ->with('dh_toihan', $dh_toihan)
        ->with('dh_quahan', $dh_quahan)   
        ->with('dh_saptoihan', $dh_saptoihan)  
        ->with('dh_datra', $dh_datra)
        ->with('dathu_tongno_kh', $dathu_tongno_kh) 
        ->with('chitiet_thu', $chitiet_thu);   
	}
 public function search($id, Request $request)
   {
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

        $chitiet_kh_date = DB::select('SELECT *,kh.kh_ten, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM dondathang dh 
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
        join khachhang kh on kh.kh_id = dh.kh_id
        left join 
                (select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
                  join chitiettrahang ctth on pth.pth_id = ctth.pth_id
                  join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' and pth.pth_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'" group by pth.ddh_id) 
                  as aaa on dh.ddh_id = aaa.donhang_id
                                WHERE dh.kh_id='.$id.' AND dh.ddh_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'" GROUP BY dh.ddh_id');
      
       
       return view('khachhang.search')
       ->with('chitiet_kh_date', $chitiet_kh_date)
       ->with('current_day', $current_day)
        ->with('current_day_add', $current_day_add)
        ->with('from_date', $from_date)
        ->with('to_date', $to_date)
        ->with('thongbao','Thành công');
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
        $this->validate($request,[
            'kh_ten'=>'required|min:3',
            'kh_sdt'=> 'required|min:10|max:10',
            'kh_diachi'=>'required',
            
    ],
    [
            'kh_ten.required'=>'Vui lòng nhập tên khách hàng',
            'kh_ten.min'=>'Tên khách hàng phải có ít nhất 3 ký tự',
            'kh_diachi.required'=>'Vui lòng nhập địa chỉ',
            'kh_sdt.required'=>'Vui lòng nhập số điện thoại ',
            'kh_sdt.min'=>'Số điện thoại phải có độ dài 10 số',
            'kh_sdt.max'=>'Số điện thoại phải có độ dài 10 số',
         
    ]);

        $kh = khachhang::where('kh_id', $id)->first();

        $kh->kh_ten = $request->kh_ten;
        $kh->kh_sdt = $request->kh_sdt;
        $kh->kh_diachi = $request->kh_diachi;

        $kh->save();

        Session::flash('alert-info','Cập nhật thành công !');
        return redirect()->route('khachhang.index');
    }
	public function pdf_chitietcongno_kh($id) {
        $kh = khachhang::find($id);
        $chitiet_kh = DB::select('SELECT *,kh.kh_ten, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
        FROM dondathang dh 
        JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
        JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
        join khachhang kh on kh.kh_id = dh.kh_id
        left join 
                (select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
                  join chitiettrahang ctth on pth.pth_id = ctth.pth_id
                  join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id
        WHERE dh.kh_id='.$id.' GROUP BY dh.ddh_id');
                               // dd($chitiet_kh);
                               
        
        $dh_first=DB::select('SELECT dh.ddh_ngaylap as ngaylap FROM dondathang dh 
                            JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                            join khachhang kh on kh.kh_id = dh.kh_id
                            WHERE dh.kh_id='.$id.' limit 1');
        //dd($dh_first);
        $dathu_tongno_kh = DB::select('SELECT kh.kh_id,kh.kh_ten, SUM(pt.pt_tienthu) as tongthu_kh,tongno 
                                        from khachhang kh 
                                        left join phieuthu pt on pt.kh_id=kh.kh_id 
                                        left join congno_khachhang cn on cn.kh_id=kh.kh_id
                                        where kh.kh_id='.$id);
                            //dd($dathu_tongno_kh);
        
        $data = [
            'kh' => $kh,
            'chitiet_kh' => $chitiet_kh,
            'dh_first' => $dh_first,
            'dathu_tongno_kh' => $dathu_tongno_kh,
        ];
        $pdf = PDF::loadView('khachhang.pdf_chitietcongno_kh',$data);
        return $pdf->stream();
}
public function excel_chitietcongno_kh($id) {
    //$dd($kh);
    $chitiet_kh = DB::select('SELECT *,kh.kh_ten, SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
    FROM dondathang dh 
    JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
    JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
    join khachhang kh on kh.kh_id = dh.kh_id
    left join 
            (select pth.pth_id, pth.pth_ctk,pth.ddh_id as donhang_id, SUM(ctth_soluong*ctth_dongia)-SUM(ctth_soluong*ctth_dongia*dh.ddh_giamchietkhau/100) giatri_trahang from phieutrahang pth
              join chitiettrahang ctth on pth.pth_id = ctth.pth_id
              join dondathang dh on dh.ddh_id = pth.ddh_id  WHERE dh.kh_id='.$id.' group by pth.ddh_id) as aaa on dh.ddh_id = aaa.donhang_id
    WHERE dh.kh_id='.$id.' GROUP BY dh.ddh_id');
    // dd($chitiet_kh);
    $dathu_tongno_kh = DB::select('SELECT kh.kh_id,kh.kh_ten, pt_id,pt_ngaylap,pt_tienthu, SUM(pt.pt_tienthu) as tongthu_kh,tongno 
            from khachhang kh 
            LEFT join phieuthu pt on pt.kh_id=kh.kh_id 
            LEFT join congno_khachhang cn on cn.kh_id=kh.kh_id
            where kh.kh_id='.$id);
    
    $kh = khachhang::find($id);
    
    return Excel::download(new Congno_Khachhang_Export($kh,$chitiet_kh,$dathu_tongno_kh), 'congno_kh.xlsx');
    //return Excel::download(['kh' => $kh,'chitiet_kh' => $chitiet_kh], 'congno_kh.xlsx');
}
    public function excel_chitietcongno_kh_time($id, $from_date, $to_date) {

        //dd($from_date);
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

        $chitiet_kh_date = DB::select('SELECT *,kh.kh_ten,SUM(ctdh.ctdh_soluong * ctdh.ctdh_dongia)-(ctdh.ctdh_soluong * ctdh.ctdh_dongia * dh.ddh_giamchietkhau/100) as tongtien
                                 FROM dondathang dh 
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                JOIN chitietdathang ctdh ON ctdh.ddh_id = dh.ddh_id
                                WHERE dh.kh_id='.$id.' AND dh.ddh_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'" GROUP BY dh.ddh_id');
    
        $kh = khachhang::find($id);

        return Excel::download(new Congno_KH_Time_Export($kh,$chitiet_kh_date,$current_day,$current_day_add,$from_date,$to_date), 'congno_kh_time.xlsx');
}
    public function phieuthu_kh($id) {

        $phieuthu_kh = DB::select('select *,name from khachhang kh 
        join phieuthu pt on pt.kh_id = kh.kh_id
        JOIN nhanvien nv on nv.id = pt.id 
        where kh.kh_id = '.$id);
        
        $kh = khachhang::where("kh_id", $id)->first();
        //dd($kh);

        return view('khachhang.phieuthu_kh')
        ->with('phieuthu_kh', $phieuthu_kh)
        ->with('kh', $kh);
    
}

}
