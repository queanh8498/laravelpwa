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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Phieutrahang_Export implements FromView, ShouldAutoSize,WithEvents 
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
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                   $pth=$this->pth;
                   $ctth=$this->ctth;
 
        // Set khổ giấy in ngang
        // $event->sheet->getDelegate()->getPageSetup()
        //     ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A6:H6')->applyFromArray(
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
       
        foreach($ctth as $index => $dsctpth)
        {
            $currentRow = $startRow + $index;
            //dd($currentRow); 
            //$event->sheet->getDelegate()->getRowDimension($currentRow)->setRowHeight(50);
            $coordinate = "A${currentRow}:H${currentRow}";

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
        // //Set border for __Summary line
        // $currentRow = $currentRow+1;
        // $coordinate = "A${currentRow}:H${currentRow}";
        // $event->sheet->getDelegate()->getStyle($coordinate)->applyFromArray(
        //     [
        //         'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP,
        //         'alignment' => [
        //             'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        //             //'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP

        //         ],
        //         'borders' => [
        //             'allBorders' => [
        //                 'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
        //                 'color' => ['argb' => '00000000'],
        //             ],
        //         ]
        //     ]
        // );
        }
    ];
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