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
class Phieutranhacungcap_Export implements FromView 
{
    protected $data;
    protected $ptncc;
    protected $ctncc;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($ptncc,$ctncc) {
        //$this->data = $data;
        $this->ptncc = $ptncc;
        $this->ctncc = $ctncc;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $ptncc=$this->ptncc;
        $ctncc=$this->ctncc;
        
       // dd($kh);
       // dd($a);
        return view('kho.phieutrancc.excel_ptncc', [
            //'data' => $data,
            'ptncc' => $ptncc,
            'ctncc' => $ctncc
            
        ]);
    }
  


}