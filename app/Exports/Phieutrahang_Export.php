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
use Carbon\Carbon;
use DateTime;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Phieutrahang_Export implements FromView 
{
    protected $data;
    protected $pth;
    protected $ctth;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($pth,$ctth) {
        //$this->data = $data;
        $this->pth = $pth;
        $this->ctth = $ctth;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $pth=$this->pth;
        $ctth=$this->ctth;
        
       // dd($kh);
       // dd($a);
        return view('kho.phieutrahang.excel_pth', [
            //'data' => $data,
            'pth' => $pth,
            'ctth' => $ctth
            
        ]);
    }
  


}