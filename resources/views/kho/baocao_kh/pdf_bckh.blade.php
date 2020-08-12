<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO NHẬP XUẤT THEO KHÁCH HÀNG </title>
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
  $date2=date("d-m-Y", strtotime($to_ht));
 ?>
   <h1><center>BÁO CÁO NHẬP XUẤT THEO KHÁCH HÀNG </center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
   <h4><center>Từ ngày:{{$date}} - Đến ngày:{{$date2}}</center></h4>
  <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{$kh->kh_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{$kh->kh_diachi}}</strong></td>
        </tr>
    </table>
             <br/>
            <table class="table_1" >
               <thead>
                <tr>
                  <th > Mã hàng hóa</th>
                  <th >Tên hàng hóa</th>
                  <th> Đơn vị</th>
                  <th >Số lượng hàng khách mua </th>
                 <th  >Số lượng hàng khách trả </th>
                  <th >Tổng</th>
              
                
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
                 @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td>{{$value3->quantity}}</td>
              
                     <?php $tck=$tck+$value3->quantity;?>
                   @endforeach
                    @else

                      
                        <td>0</td>
                    @endif
               @if(!$data2->isEmpty())
                @foreach ($data2 as $key2 => $value2)
                    
                   <td>{{$value2->quantity}}</td>
                
                     <?php $tck=$tck-$value2->quantity;?>
                   @endforeach
                    @else

                     
                        <td>0</td>
                    @endif
                  
                    <td>{{$tck}}</td>
                  
               @endforeach
                </tbody>
              </table>
 
  
       
      <hr style="color: black; margin-top: 150px;" />
   
</body>
</html>