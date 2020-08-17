<?php

namespace App\Exports;
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

class DonHang_Time_Export implements FromView, ShouldAutoSize,WithEvents
{
    protected $chitiet_ddh_date;
    protected $current_day;
    protected $current_day_add;
    protected $from_date;
    protected $to_date;
    //protected $ddh;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function __construct($chitiet_ddh_date,$current_day,$current_day_add,$from_date, $to_date) {
        //$this->data = $data;
        //$this->ddh = $ddh;
        $this->chitiet_ddh_date = $chitiet_ddh_date;
        $this->current_day = $current_day;
        $this->current_day_add = $current_day_add;
        $this->from_date = $from_date;
        $this->to_date = $to_date;
        
    }

    public function  registerEvents(): array{
        
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $chitiet_ddh_date=$this->chitiet_ddh_date;
                $current_day=$this->current_day;
                $current_day_add=$this->current_day_add;
                $from_date=$this->from_date;
                $to_date=$this->to_date;

            // Set khổ giấy in ngang
            $event->sheet->getDelegate()->getPageSetup()
                ->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
            
            // Format dòng tiêu đề "Tiêu đề cột"
            $event->sheet->getDelegate()->getStyle('A7:J7')->applyFromArray(
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
            $startRow =   8;
        
            foreach($chitiet_ddh_date as $index=>$chitiet_ddh_date)
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
            $currentRow = $currentRow;
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
        ];
    }

    public function view(): View
    {
        //$ddh=$this->ddh;
        $chitiet_ddh_date=$this->chitiet_ddh_date;
        $current_day=$this->current_day;
        $current_day_add=$this->current_day_add;
        $from_date=$this->from_date;
        $to_date=$this->to_date;
        
        return view('dondathang.excel_ddh_time', [
            //'ddh' => $ddh,
            'chitiet_ddh_date' => $chitiet_ddh_date,
            'current_day' => $current_day,
            'current_day_add' => $current_day_add,
            'from_date' => $from_date,
            'to_date' => $to_date,
        ]);
    }
}
