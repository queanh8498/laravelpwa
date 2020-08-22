<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU TRẢ NHÀ CUNG CẤP</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
 <?php 
  $date=date("d-m-Y", strtotime($ptncc->ptncc_ngaylap));
 ?>
 <body>
 <table>
    <thead>
        <tr>
            <th colspan="7" style="font-size:20px;text-align:center">
                <strong>PHIẾU TRẢ NHÀ CUNG CẤP</strong>
            </th>
        </tr>
        <tr>
            <th colspan="7" style="font-size:16px;text-align:center">
                Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}
            </th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
        <td colspan="3"> <i>Nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_ten}}</strong></td>
        <td></td>
        <td colspan="3" style="text-align:right;"> <i>Địa chỉ nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_diachi}}</strong></td>
        </tr>
        <tr>
        <td colspan="3">  <i>Tạo bởi phiếu nhập: </i><strong>PNK00{{$ptncc->pnk_id}}</strong></td>
        <td></td>
        <td></td>
        </tr>
      
        
    </tbody>
</table>
 <table border="1" width=100% >
        <thead>
           <tr>
                <th  style="text-align:center;width:5px">STT</th>
                <th  style="text-align:center;width:15px" >Tên hàng hóa</th>
                <th  style="text-align:center;width:10px">Đơn vị tính</th>
                <th  style="text-align:center;width:15px">Số lượng</th>
                <th  style="text-align:center;width:12px">Đơn giá</th>
                <th  style="text-align:center;width:18px">Thành tiền</th>
           </tr>
        </thead> 
        <tbody>
          <?php $i=1; 
                     $total=0;
                     ?>
          @foreach($ctncc as $key => $dsctptncc)
            <tr  style="border: 1px thin #000" align=center >
                <td style="text-align:center;width:5px">
                   {{$i++}}
                </td>
                <td style="text-align:center;width:15px" >
                 {{$dsctptncc->hh_ten}}
                </td>
                <td style="text-align:center;width:10px">
                  {{$dsctptncc->hh_donvitinh}}
                </td>
                <td style="text-align:center;width:15px">
                   {{$dsctptncc->ctncc_soluong}}
                </td>
                <td style="text-align:center;width:15px">
                    {{number_format($dsctptncc->ctncc_dongia,0,',',',')}}
                </td>
                  <td style="text-align:center;width:18px">
                    {{number_format($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia,0,',',',')}}
                  </td>
                 
               <?php
            $total=$total+($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia);
             ?>   
              
            </tr>
             @endforeach
            <tr style="border: 1px thin #000" align="center"> 
            <th style="font-size:15px" colspan="5"><strong>Tổng tiền</strong></th>
            <th style="text-align:center;font-size:18px"><strong>{{ number_format($total,0,',',',') }}</strong></th>
            </tr>

        </tbody>
    </table>
  <table>
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
                 <strong>Người lập phiếu</strong>
                </td>
                 <td>
                </td>  
                 <td>
                </td>       
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
               <strong>Nhà cung cấp</strong>
                </td>
               
            </tr>
        </table>
    
</body>
  


</html>