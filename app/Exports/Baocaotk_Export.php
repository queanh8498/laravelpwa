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
use App\khohang;
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
class Baocaotk_Export implements FromView 
{
    protected $data;
    protected  $date;
    protected  $khohang;
  
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($date,$data,$khohang) {
        //$this->data = $data;
        $this->khohang = $khohang;
        $this->date = $date;
         $this->data = $data;
         
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $khohang=$this->khohang;
        $date=$this->date;
         $data=$this->data;
      
        
       // dd($kh);
       // dd($a);
        return view('kho.baocao_tk.excel_bctk', [
            //'data' => $data,
            'khohang' => $khohang,
            'date' => $date,
            'data' => $data,
           
            
        ]);
    }
  


}