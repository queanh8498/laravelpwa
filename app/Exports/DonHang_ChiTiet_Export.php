<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use App\Invoice;
use Maatwebsite\Excel\Concerns\WithColumnWidth;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
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

class DonHang_ChiTiet_Export implements FromView, ShouldAutoSize,WithEvents
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
    
    public function  registerEvents(): array
    {
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $ddh=$this->ddh;
                $ddh0=$this->ddh0;
                $ddh1=$this->ddh1;
                $ddh2=$this->ddh2;

        // Set khổ giấy in ngang
        // $event->sheet->getDelegate()->getPageSetup()
        //     ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
        
        // Format dòng tiêu đề "Tiêu đề cột"
        $event->sheet->getDelegate()->getStyle('A9:I9')->applyFromArray(
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
        $startRow =   9;
       
        foreach($ddh1 as $index=>$ddh1)
        {
            $currentRow = $startRow + $index;
            //dd($currentRow); 
            //$event->sheet->getDelegate()->getRowDimension($currentRow)->setRowHeight(50);
            $coordinate = "A${currentRow}:I${currentRow}";

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
        $coordinate = "A${currentRow}:I${currentRow}";
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
