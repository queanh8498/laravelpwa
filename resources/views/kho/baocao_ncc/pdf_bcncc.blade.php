<!DOCTYPE html>
<html>
<head>
    <title>Báo cáo nhập xuất tồn theo nhà cung cấp</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>body{
            font-family: DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling tbody tr td  {
            border:1px solid #000;
        }
        </style>
</head>
<body>
<?php 

  $date=date("d-m-Y", strtotime($from));
  $date1=date("d-m-Y", strtotime($to));
 ?>
   <h1><center>Báo cáo</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
   <h4><center>Từ ngày: {{$date}} - Đến ngày: {{$date1}}</center></h4>
  <p>Nhà cung cấp: {{$ncc->ncc_ten}}</p>
             
            <table class="table-styling" >
               <thead>
                <tr>
                   <th rowspan="2" style=" border:1px solid #000; "> Mã hàng hóa</th>
                   <th rowspan="2" style=" border:1px solid #000; "> Tên hàng hóa</th> 
                   <th rowspan="2" style=" border:1px solid #000; "> Đơn vị</th> 
                      <th colspan="2" style=" border:1px solid #000;"> Tồn đầu kỳ</th>
                       <th  colspan="2" style=" border:1px solid #000;"> Nhập trong kỳ</th>
                        <th  colspan="2" style=" border:1px solid #000;"> Xuất trong kỳ </th>
                      <th  colspan="2" style=" border:1px solid #000;"> Tồn cuối kỳ</th>
                </tr>
                <tr>    
                
                <th style=" border:1px solid #000;">Số lượng</th>
                 <th style=" border:1px solid #000;">Đơn giá</th>  
                  <th style=" border:1px solid #000;">Số lượng</th>
                 <th style=" border:1px solid #000;">Đơn giá</th>  
                  <th style=" border:1px solid #000;">Số lượng</th>
                 <th style=" border:1px solid #000;">Đơn giá</th>  
                  <th style=" border:1px solid #000;">Số lượng</th>
                 <th style=" border:1px solid #000;">Đơn giá</th>  
                         
                </tr>
             
               </thead>
               <tbody>
               
                 @foreach ($data as $key => $value) 
          <?php  $tck=0;?>
               <tr>
             <td>HH00{{$value->hh_id}}</td>
               <td>{{$value->hh_ten}}</td>
              <td>{{$value->hh_donvitinh}}</td>
              <?php   $data1=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->where('phieunhapkho.pnk_ngaynhapkho','<', $from)->groupBy('hanghoa.hh_id')->get();?>
                @if(!$data1->isEmpty())
                @foreach ($data1 as $key1 => $value1)
                    
                   <td>{{$value1->quantity}}</td>
                   <td>{{number_format($value1->total,0,',','.')}}</td>
                     <?php $tck=$tck+$value1->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
             <?php
              $data2=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieunhapkho.pnk_ngaynhapkho', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitiettrancc')
               ->join('phieutrancc','phieutrancc.ptncc_id','=','chitiettrancc.ptncc_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrancc.hh_id')
               ->select(DB::raw('sum(ctncc_soluong) as quantity,sum(ctncc_soluong*ctncc_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieutrancc.ptncc_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
              ?>
               @if(!$data2->isEmpty())
                @foreach ($data2 as $key2 => $value2)
                    
                   <td>{{$value2->quantity}}</td>
                   <td>{{number_format($value2->total,0,',','.')}}</td>
                     <?php $tck=$tck+$value2->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
                     @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td>{{$value3->quantity}}</td>
                   <td>{{number_format($value3->total,0,',','.')}}</td>
                     <?php $tck=$tck-$value3->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
                    <td>{{$tck}}</td>
                    <td>{{number_format($tck*$value->hh_dongia,0,',','.')}}</td>
               @endforeach
                </tbody>
              </table>
 
  
       
      <p>---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</p>
   
</body>
</html>