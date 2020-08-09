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
use App\hanghoa;
use Carbon\Carbon;
use DateTime;
use DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Congno_Khachhang_Export implements FromView
{
    protected $data;
    protected $kh;
    protected $chitiet_kh;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($kh,$chitiet_kh) {
        //$this->data = $data;
        $this->kh = $kh;
        $this->chitiet_kh = $chitiet_kh;
        
    }
   
    
    public function view(): View
    {
        
        //$data=$this->data;
        $kh=$this->kh;
        $chitiet_kh=$this->chitiet_kh;
        
       // dd($kh);
       // dd($a);
        return view('khachhang.excel_chitietcongno_kh', [
            //'data' => $data,
            'kh' => $kh,
            'chitiet_kh' => $chitiet_kh
            
        ]);
    }
}