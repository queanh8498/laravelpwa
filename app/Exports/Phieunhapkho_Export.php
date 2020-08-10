<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Invoice;
use Maatwebsite\Excel\Concerns\WithColumnWidth;

use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

use App\User;
use App\khachhang;
use App\dondathang;
use App\nhomhanghoa;
use App\nhacungcap;
use App\hanghoa;
use App\khohang;
use App\phieunhapkho;
use App\chitietphieunhap;
use Carbon\Carbon;
use DateTime;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Phieunhapkho_Export implements FromView 
{
    protected $data;
    protected $pnk;
    protected $ctpn;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($pnk,$ctpn) {
        //$this->data = $data;
        $this->pnk = $pnk;
        $this->ctpn = $ctpn;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $pnk=$this->pnk;
        $ctpn=$this->ctpn;
        
       // dd($kh);
       // dd($a);
        return view('kho.phieunhapkho.excel_pnk', [
            //'data' => $data,
            'pnk' => $pnk,
            'ctpn' => $ctpn
            
        ]);
    }
  


}