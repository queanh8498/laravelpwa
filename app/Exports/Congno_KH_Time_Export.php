<?php

namespace App\Exports;
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

class Congno_KH_Time_Export implements FromView
{
    protected $chitiet_kh_date;
    protected $current_day;
    protected $current_day_add;
    protected $from_date;
    protected $to_date;
    protected $kh;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($kh,$chitiet_kh_date,$current_day,$current_day_add,$from_date, $to_date) {
        //$this->data = $data;
        $this->kh = $kh;
        $this->chitiet_kh_date = $chitiet_kh_date;
        $this->current_day = $current_day;
        $this->current_day_add = $current_day_add;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        
    }
    public function view(): View
    {
        $kh=$this->kh;
        $chitiet_kh_date=$this->chitiet_kh_date;
        $current_day=$this->current_day;
        $current_day_add=$this->current_day_add;
        $from_date=$this->from_date;
        $to_date=$this->to_date;
        
        return view('khachhang.excel_chitietcongno_kh_time', [
            'kh' => $kh,
            'chitiet_kh_date' => $chitiet_kh_date,
            'current_day' => $current_day,
            'current_day_add' => $current_day_add,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }
}
