<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithColumnWidth;

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
use Maatwebsite\Excel\Concerns\WithEvents;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


class Congno_KH_Time_Export implements FromView, ShouldAutoSize,WithEvents
{
    protected $chitiet_kh_date;
    protected $dathu_tongno_kh_date;
    protected $current_day;
    protected $current_day_add;
    protected $from_date;
    protected $to_date;
    protected $kh;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($kh,$chitiet_kh_date, $dathu_tongno_kh_date,$from_date, $to_date,$current_day,$current_day_add) {
        //$this->data = $data;
        $this->kh = $kh;
        $this->chitiet_kh_date = $chitiet_kh_date;
        $this->dathu_tongno_kh_date = $dathu_tongno_kh_date;

        $this->from_date = $from_date;
        $this->to_date = $to_date;

        $this->current_day = $current_day;
        $this->current_day_add = $current_day_add;
        
        
    }
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $kh=$this->kh;
                $chitiet_kh_date=$this->chitiet_kh_date;
                $dathu_tongno_kh_date=$this->dathu_tongno_kh_date;
                $from_date=$this->from_date;
                $to_date=$this->to_date;
                $current_day=$this->current_day;
                $current_day_add=$this->current_day_add;
               // dd($dathu_tongno_kh_date);

        // Set khổ giấy in ngang
        $event->sheet->getDelegate()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A9:J10')->applyFromArray(
            [
                'font' => [
                    'bold' => true,
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                ],

                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ]
            ]
        );
        // Dòng bắt đầu xuất Excel danh sách sản phẩm
        $startRow =   11;
       
        foreach($chitiet_kh_date as $index=>$chitiet_kh_date)
        {
            $currentRow = $startRow + $index;
           
            //dd($currentRow); 
            $coordinate = "A${currentRow}:J${currentRow}";
            

            $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
                [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ]
                ]
            );
        }
        //Set border for __Summary line
        $currentRow = $currentRow+1;
        $row = $currentRow+3;
        $coordinate = "A${currentRow}:J${row}";
        $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
            [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,

                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['argb' => '00000000'],
                    ],
                ]
            ]
        );
        }
    ];
    }

    public function view(): View
    {
        $kh=$this->kh;
        $dathu_tongno_kh_date=$this->dathu_tongno_kh_date;
        $chitiet_kh_date=$this->chitiet_kh_date;
        $current_day=$this->current_day;
        $current_day_add=$this->current_day_add;
        $from_date=$this->from_date;
        $to_date=$this->to_date;
        
        return view('khachhang.excel_chitietcongno_kh_time', [
            'kh' => $kh,
            'chitiet_kh_date' => $chitiet_kh_date,
            'dathu_tongno_kh_date' => $dathu_tongno_kh_date,
            'current_day' => $current_day,
            'current_day_add' => $current_day_add,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }
}
