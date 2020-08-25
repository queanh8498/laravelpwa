<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO NHẬP XUẤT TỒN THEO NHÀ CUNG CẤP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
   <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
        .table_0, .table_1, .table_2, .tieude{
            border-collapse: collapse;
        }
        .tieude{
            /* border: 1px solid #000; */
            border: none;
            width: 100%;
        }
        /* .tieude td{
            border: 1px solid #000;
        } */
        .phieubanhang{
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin-bottom: 5px;
            padding-left: 134px;
        }
        .ma_don{
            text-align: right;
        }
        .table_0{
            width: 100%;
            border: none;
            margin-bottom: 10px;
        }
        .table_1{
            width: 100%;
            margin-top: 5px;
        }
        .table_1 th{
            border: 1px solid #000;
        }
        .table_1 td{
            border: 1px solid #000;
        }
        .table_2{
            border: none;
            width: 310px;
            margin-right: -80px;
        }
        .table_2 th{
            text-align: left;
        }
        .table_2 td{
            text-align: right;
        }
        .table_3{
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .table_3 th{
            text-align: center;
            /* border: 1px solid #000; */
        }
    </style>
</head>
<body>
<?php 

  $date=date("d-m-Y", strtotime($from));
  $date1=date("d-m-Y", strtotime($to));
 ?>
   <h1><center>BÁO CÁO NHẬP XUẤT TỒN THEO NHÀ CUNG CẤP</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
   <h4><center>Từ ngày:{{$date}} - Đến ngày:{{$date1}}</center></h4>
       <table width=100%>
        <tr>
            <td><i>Nhà cung cấp: </i><strong>{{$ncc->ncc_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ nhà cung cấp: </i><strong>{{$ncc->ncc_diachi}}</strong></td>
        </tr>
        
    </table>
            <table class="table_1">
               <thead>
                <tr>
                   <th rowspan="2" > Mã hàng hóa</th>
                   <th rowspan="2"> Tên hàng hóa</th> 
                   <th rowspan="2" > Đơn vị</th> 
                      <th colspan="2" > Tồn đầu kỳ</th>
                       <th  colspan="2" > Nhập trong kỳ</th>
                        <th  colspan="2" > Xuất trong kỳ </th>
                      <th  colspan="2"> Tồn cuối kỳ</th>
                </tr>
                <tr>    
                
                <th >Số lượng</th>
                 <th>Đơn giá</th>  
                  <th>Số lượng</th>
                 <th >Đơn giá</th>  
                  <th >Số lượng</th>
                 <th >Đơn giá</th>  
                  <th >Số lượng</th>
                 <th>Đơn giá</th>  
                         
                </tr>
             
               </thead>
               <tbody>
               
                 @foreach ($data as $key => $value) 
          <?php  $tck=0;?>
               <tr  align=center>
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
                   <td>{{number_format($value1->total,0,',',',')}}</td>
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
                   <td>{{number_format($value2->total,0,',',',')}}</td>
                     <?php $tck=$tck+$value2->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
                     @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td>{{$value3->quantity}}</td>
                   <td>{{number_format($value3->total,0,',',',')}}</td>
                     <?php $tck=$tck-$value3->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
                    <td>{{$tck}}</td>
                    <td>{{number_format($tck*$value->hh_dongia,0,',',',')}}</td></tr>
               @endforeach
                </tbody>
              </table>
 
  
       
    <hr style="color: black; margin-top: 150px;" />
   
</body>
</html>