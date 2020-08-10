<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU TRẢ NHÀ CUNG CẤP-ptncc00{{$ptncc->ptncc_id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
 <?php 
  $date=date("d-m-Y", strtotime($ptncc->ptncc_ngaylap));
 ?>
   <body style="font-size: 10px">
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
           
            <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>PHIẾU TRẢ NHÀ CUNG CẤP</b>
                </td>
            </tr>
              <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 16px">
                   Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}
                </td>
            </tr>
            <tr>
                <td colspan="3" class="caption" align="left" style="text-align: center; font-size: 12px">
                <i>Nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_ten}}</strong>
                </td>
                  <td colspan="3" class="caption" align="right" style="text-align: center; font-size: 12px">
              <i>Địa chỉ nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_diachi}}</strong>
                </td>
               
            </tr>
             <tr>
                <td colspan="3" class="caption" align="left" style="text-align: center; font-size: 12px">
               <i>Tạo bởi phiếu nhập: </i><strong>PNK00{{$ptncc->pnk_id}}</strong>
                </td>
                  
               
            </tr>
            <tr style="border: 1px thin #000;">
                <th style="text-align: center">STT</th>
                <th style="text-align: center">Tên hàng hóa</th>
                <th style="text-align: center">Đơn vị tính</th>
                <th style="text-align: center">Số lượng</th>
                <th style="text-align: center">Đơn giá</th>
                 <th style="text-align: center">Thành tiền</th>
            </tr>
              <?php $i=1; 
                     $total=0;
                     ?>
          @foreach($ctncc as $key => $dsctptncc)
            <tr style="border: 1px thin #000; " >
                <td align="center" valign="middle" width="5">
                   {{$i++}}
                </td>
                <td align="center" valign="middle" width="20" >
                   {{$dsctptncc->hh_ten}}
                </td>
                <td align="left" valign="middle" width="30">
                  {{$dsctptncc->hh_donvitinh}}
                </td>
                <td align="right" valign="middle" width="15">
                  {{$dsctptncc->ctncc_soluong}}
                </td>
                  <td align="right" valign="middle" width="15">
                    {{number_format($dsctptncc->ctncc_dongia,0,',','.')}}
                  </td>
                    <td align="left" width="15" valign="middle">
                      {{number_format($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia,0,',','.')}}
                    </td>
               <?php
            $total=$total+($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia);
             ?>   
              
            </tr>
             @endforeach
               <tr align="center"> 
            <th style="text-align: center; font-size: 15px" colspan="5"><strong>Tổng tiền</strong></th>
            <th style="text-align:center;font-size:15px"><strong>{{ number_format($total,0,',',',') }}</strong></th>
            </tr>
            <tr></tr>
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
                 <i>Người lập phiếu</i>
                </td>
                <td></td>
                  <td></td>
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
               <i>Nhà cung cấp</i>
                </td>
               
            </tr>
        </table>

    </div>
</body>


</html>