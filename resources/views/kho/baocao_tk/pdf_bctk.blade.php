<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO TỒN KHO TỨC THỜI</title>
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
             
            <table  border="1" width=100% >
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
                <td> {{number_format($value->hh_dongia,0,',','.')}}</td>
           <td> {{number_format($value->hh_soluong*$value->hh_dongia,0,',','.')}}</td>
          
               @endforeach
                </tbody>
              </table>
 
  
       
    <hr style="color: black; margin-top: 150px;" />
   
</body>
</html>