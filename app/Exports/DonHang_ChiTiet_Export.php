<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Invoice;
use Maatwebsite\Excel\Concerns\WithColumnWidth;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use DB;
use Auth;
use Carbon\Carbon;
use Datetime;
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

class DonHang_ChiTiet_Export implements FromView
{
    protected $data;
    protected $ddh;
    protected $ddh0;
    protected $ddh1;
    protected $ddh2;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($ddh, $ddh0, $ddh1, $ddh2) {
        //$this->data = $data;
        $this->ddh = $ddh;
        $this->ddh0 = $ddh0;
        $this->ddh1 = $ddh1;
        $this->ddh2 = $ddh2;    
    }
   
    
    public function view(): View
    {
        //$data=$this->data;
        $ddh = $this->ddh;
        $ddh0 =  $this->ddh0;
        $ddh1 =  $this->ddh1;
        $ddh2 =  $this->ddh2;
        
       // dd($kh);
       // dd($a);
        return view('dondathang.excel_ddh', [
            //'data' => $data,
            'ddh' => $ddh,
            'ddh0' => $ddh0,
            'ddh1' => $ddh1,
            'ddh2' => $ddh2
            
        ]);
    }
}
