<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
 
   <body style="font-size: 10px">
  <?php 

  $date=date("d-m-Y", strtotime($date));
 
 ?>
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
           
            <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>BÁO CÁO TỒN KHO TỨC THỜI</b>
                </td>
            </tr>
           <tr>

                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 15px">
                   Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}
                </td>
            </tr>
             
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
              <i>Kho hàng: </i><strong>{{$khohang->kho_ten}}</strong>
                </td>
                <td></td>
                 <td></td>
               
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
           <i>Địa chỉ: </i><strong>{{$khohang->kho_diachi}}</strong>
                </td>
               <tr></tr>
          
              <tr style="border: 1px thin #000;">
                  <th style="text-align: center" align="center" valign="middle" width="12"> Mã hàng hóa</th>
                  <th style="text-align: center" align="center" valign="middle" width="15"> Tên hàng hóa</th> 
                  <th style="text-align: center" align="center" valign="middle" width="15"> Đơn vị</th> 
                  <th style="text-align: center" align="center" valign="middle" width="20">Số lượng tồn</th>
                  <th style="text-align: center" align="center" valign="middle" width="20" >Đơn giá </th>
                  <th style="text-align: center" align="center" valign="middle" width="20">Giá trị</th>
               

            </tr>
              
                  @foreach ($data as $key => $value) 
               <tr  align=center>
             <td align="center" valign="middle" width="12">HH00{{$value->hh_id}}</td>
               <td align="center" valign="middle" width="15">{{$value->hh_ten}}</td>
              <td align="center" valign="middle" width="15">{{$value->hh_donvitinh}}</td>
               <td  align="center" valign="middle" width="20">{{$value->hh_soluong}}</td>
                <td  align="center" valign="middle" width="20"> {{number_format($value->hh_dongia,0,',','.')}}</td>
           <td  align="center" valign="middle" width="20"> {{number_format($value->hh_soluong*$value->hh_dongia,0,',','.')}}</td>
          
               @endforeach
                
 </table>

    </div>
</body>


</html>