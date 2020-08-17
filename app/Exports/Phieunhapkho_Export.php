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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Phieunhapkho_Export implements FromView, ShouldAutoSize,WithEvents 
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
   
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                   $pnk=$this->pnk;
                   $ctpn=$this->ctpn;
 
        // Set khổ giấy in ngang
        // $event->sheet->getDelegate()->getPageSetup()
        //     ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A6:G6')->applyFromArray(
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
        $startRow =   7;
       
        foreach($ctpn as $index=>$dsctpn)
        {
            $currentRow = $startRow + $index;
            //dd($currentRow); 
            //$event->sheet->getDelegate()->getRowDimension($currentRow)->setRowHeight(50);
            $coordinate = "A${currentRow}:G${currentRow}";

            $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
                [
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                        //'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP

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
        $coordinate = "A${currentRow}:G${currentRow}";
        $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
            [
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    //'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP

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