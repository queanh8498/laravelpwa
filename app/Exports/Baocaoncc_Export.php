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
class Baocaoncc_Export implements FromView 
{
    protected $data;
    protected  $from;
    protected  $to;
    protected  $ncc;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from,$to,$data,$ncc) {
        //$this->data = $data;
        $this->from = $from;
        $this->to = $to;
         $this->data = $data;
          $this->ncc = $ncc;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $from=$this->from;
        $to=$this->to;
         $data=$this->data;
          $ncc=$this->ncc;
        
       // dd($kh);
       // dd($a);
        return view('kho.baocao_ncc.excel_bcncc', [
            //'data' => $data,
            'from' => $from,
            'to' => $to,
            'data' => $data,
            'ncc' => $ncc,
            
        ]);
    }
  


}