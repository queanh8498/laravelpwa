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
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;


// class Congno_Khachhang_Export implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
class Baocaokh_Export implements FromView  , ShouldAutoSize,WithEvents
{
    protected $data;
    protected  $from;
    protected  $to;
    protected  $kh;
    protected  $to_ht;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($from,$to,$data,$kh,$to_ht) {
        //$this->data = $data;
        $this->from = $from;
        $this->to = $to;
         $this->data = $data;
          $this->kh = $kh;
          $this->to_ht=$to_ht;
        
    }
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                     $from=$this->from;
                     $to=$this->to;
                     $data=$this->data;
                     $kh=$this->kh;
                     $to_ht=$this->to_ht;
 
        // Set khổ giấy in ngang
        $event->sheet->getDelegate()->getPageSetup()
            ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A6:F6')->applyFromArray(
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
        $startRow =   7;
       
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
        $from=$this->from;
        $to=$this->to;
         $data=$this->data;
          $kh=$this->kh;
          $to_ht=$this->to_ht;
        
       // dd($kh);
       // dd($a);
        return view('kho.baocao_kh.excel_bckh', [
            //'data' => $data,
            'from' => $from,
            'to' => $to,
            'data' => $data,
            'kh' => $kh,
            'to_ht'=>$to_ht,
            
        ]);
    }
  


}