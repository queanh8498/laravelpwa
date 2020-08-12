<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Invoice;
use Maatwebsite\Excel\Concerns\WithColumnWidth;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\User;
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
use App\phieutrancc;
use App\chitiettrancc;
use Carbon\Carbon;
use DateTime;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Baocaokh_Export implements FromView 
{
    protected $data;
    protected  $from;
    protected  $to;
    protected  $kh;
    protected  $to_ht;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from,$to,$data,$kh,$to_ht) {
        //$this->data = $data;
        $this->from = $from;
        $this->to = $to;
         $this->data = $data;
          $this->kh = $kh;
          $this->to_ht=$to_ht;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $from=$this->from;
        $to=$this->to;
         $data=$this->data;
          $kh=$this->kh;
          $to_ht=$this->to_ht;
        
       // dd($kh);
       // dd($a);
        return view('kho.baocao_kh.excel_bckh', [
            //'data' => $data,
            'from' => $from,
            'to' => $to,
            'data' => $data,
            'kh' => $kh,
            'to_ht'=>$to_ht,
            
        ]);
    }
  


}