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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;

// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Baocaotk_Export implements FromView , ShouldAutoSize,WithEvents
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
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                   $khohang=$this->khohang;
                   $date=$this->date;
                   $data=$this->data;
 
        // Set khổ giấy in ngang
        $event->sheet->getDelegate()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A5:F5')->applyFromArray(
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
        // // Dòng bắt đầu xuất Excel danh sách sản phẩm
        $startRow =   6;
       
        foreach($data as $index=>$value)
        {
            $currentRow = $startRow + $index;
            //dd($currentRow); 
            //$event->sheet->getDelegate()->getRowDimension($currentRow)->setRowHeight(50);
            $coordinate = "A${currentRow}:F${currentRow}";

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
        // $coordinate = "A${currentRow}:G${currentRow}";
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