<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO TỒN KHO TỨC THỜI</title>
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

  $date=date("d-m-Y", strtotime($date));
 
 ?>
   <h1><center>BÁO CÁO TỒN KHO TỨC THỜI</center></h1>
 <span><center>Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}</center></span> 
  
   <table width=100%>
        <tr>
            <td><i>Kho hàng: </i><strong>{{$khohang->kho_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{$khohang->kho_diachi}}</strong></td>
        </tr>
        
    </table>
             
            <table  class="table_1">
               <thead>
               
                    <tr>
                   <th > Mã hàng hóa</th>
                    <th>Tên hàng hóa</th>
                    <th> Đơn vị</th>
                      <th> Số lượng tồn</th>
                       <th> Đơn giá</th>
                        <th>Giá trị</th>
                     
                </tr>
              
             
               </thead>
               <tbody>
               
                 @foreach ($data as $key => $value) 
               <tr  align=center>
             <td>HH00{{$value->hh_id}}</td>
               <td>{{$value->hh_ten}}</td>
              <td>{{$value->hh_donvitinh}}</td>
               <td>{{$value->hh_soluong}}</td>
                <td> {{number_format($value->hh_dongia,0,',',',')}}</td>
           <td> {{number_format($value->hh_soluong*$value->hh_dongia,0,',',',')}}</td>
          
               @endforeach
                </tbody>
              </table>
 
  
       
    <hr style="color: black; margin-top: 150px;" />
   
</body>
</html>