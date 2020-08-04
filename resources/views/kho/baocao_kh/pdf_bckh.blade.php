<!DOCTYPE html>
<html>
<head>
    <title>Báo cáo nhập xuất  theo khách hàng </title>
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
   <h1><center>Báo cáo nhập xuất theo khách hàng</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
   <h4><center>Từ ngày: {{$date}} - Đến ngày: {{$date1}}</center></h4>
  <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{$kh->kh_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{$kh->kh_diachi}}</strong></td>
        </tr>
    </table>
             <br/>
            <table border="1" width=100%  >
               <thead>
                <tr>
                  <th rowspan="2" > Mã hàng hóa</th>
                  <th rowspan="2" >Tên hàng hóa</th>
                  <th rowspan="2"> Đơn vị</th>
                  <th  colspan="2"> Khách trả hàng</th>
                 <th  colspan="2"> Khách mua hàng </th>
                  <th  colspan="2">Tổng</th>
              
                
                </tr>
                <tr>    
                
                <th >Số lượng</th>
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
             
             <?php
             $data2=DB::table('chitiettrahang')
               ->join('phieutrahang','phieutrahang.pth_id','=','chitiettrahang.pth_id')
              ->join('dondathang','phieutrahang.ddh_id','=','dondathang.ddh_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrahang.hh_id')
               ->select(DB::raw('sum(ctth_soluong) as quantity,sum(ctth_soluong*ctth_dongia) as total'))
                ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$kh->kh_id]])
               ->whereBetween('phieutrahang.pth_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitietdathang')
                  ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
                  ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
               ->select(DB::raw('sum(ctdh_soluong) as quantity,sum(ctdh_soluong*ctdh_dongia) as total'))
               ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$kh->kh_id]])
               ->whereBetween('dondathang.ddh_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
              ?>
               @if(!$data2->isEmpty())
                @foreach ($data2 as $key2 => $value2)
                    
                   <td>{{$value2->quantity}}</td>
                   <td>{{number_format($value2->total,0,',','.')}}</td>
                     <?php $tck=$tck-$value2->quantity;?>
                   @endforeach
                    @else

                        <td>0</td>
                        <td>0</td>
                    @endif
                     @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td>{{$value3->quantity}}</td>
                   <td>{{number_format($value3->total,0,',','.')}}</td>
                     <?php $tck=$tck+$value3->quantity;?>
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
 
  
       
      <hr style="color: black; margin-top: 150px;" />
   
</body>
</html>