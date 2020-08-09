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
use Carbon\Carbon;
use DateTime;
use Barryvdh\DomPDF\Facade as PDF;

  
use App\Exports\Congno_Khachhang_Export;
use Maatwebsite\Excel\Facades\Excel;
  

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
        $current_day=$a->format("Y-m-d");
        //lấy ngày hiện tại + 5 -> format lại
        $current_day_add=$a->addDays(5);
        $b = $current_day_add;
        $current_day_add=$b->format("Y-m-d");
		
		//dd($current_day); //ok
       //dd($current_day_add); //ok 

       //sau khi format thì đã có thể so sánh được
        //  if( $current_day < $current_day_add){ $t = 1; }
        //  dd($t); 

        return view('khachhang.chitiet')
        ->with('chitiet_kh', $chitiet_kh)
        ->with('current_day', $current_day)
        ->with('current_day_add', $current_day_add);   
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

        $chitiet_kh_date = DB::select('SELECT *,kh.kh_ten FROM dondathang dh 
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                WHERE dh.kh_id='.$id.' AND dh.ddh_ngaylap BETWEEN "'.$from_date.'" AND "'.$to_date_1.'" ');
       // dd($chitiet_kh_date);

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
        $chitiet_kh = DB::select('SELECT *,kh.kh_ten FROM dondathang dh 
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                WHERE dh.kh_id='.$id);
        
        $dh_first=DB::select('SELECT dh.ddh_ngaylap as ngaylap FROM dondathang dh 
                            JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                            join khachhang kh on kh.kh_id = dh.kh_id
                            WHERE dh.kh_id='.$id.' limit 1');
        //dd($dh_first);
        
        $data = [
            'kh' => $kh,
            'chitiet_kh' => $chitiet_kh,
            'dh_first' => $dh_first,
        ];
        $pdf = PDF::loadView('khachhang.pdf_chitietcongno_kh',$data);
        return $pdf->stream();
}
    public function excel_chitietcongno_kh($id) {

        //$dd($kh);
        $chitiet_kh = DB::select('SELECT dh.ddh_id,dh.ddh_ngaylap, dh.ddh_datra,bc.bccn_soducongno FROM dondathang dh 
                                JOIN baocaocongno bc ON bc.ddh_id=dh.ddh_id
                                join khachhang kh on kh.kh_id = dh.kh_id
                                WHERE dh.kh_id='.$id);
        
        
        $kh = khachhang::find($id);
        
        // $data = new Congno_Khachhang_Export([
        //     'chitiet_kh' => $chitiet_kh,
        //     //'dh_first' => $dh_first,
        //     'kh' => $kh,
        // ]);
       // dd($kh);
        
        return Excel::download(new Congno_Khachhang_Export($kh,$chitiet_kh), 'congno_kh.xlsx');
        //return Excel::download(['kh' => $kh,'chitiet_kh' => $chitiet_kh], 'congno_kh.xlsx');

}

}

