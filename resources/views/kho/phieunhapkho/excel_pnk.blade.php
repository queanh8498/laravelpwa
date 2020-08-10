<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU NHẬP KHO-PNK00{{$pnk->pnk_id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php 

  $date=date("d-m-Y", strtotime($pnk->pnk_ngaynhapkho));
 ?>
   <body style="font-size: 10px">
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
           
            <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>PHIẾU NHẬP KHO</b>
                </td>
            </tr>
              <tr>
                <td colspan="6" class="caption" align="center" style="text-align: center; font-size: 16px">
                   Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}
                </td>
            </tr>
            <tr>
                <td colspan="3" class="caption" align="left" style="text-align: center; font-size: 12px">
                  <i>Kho nhập: </i><strong>{{$pnk->khohang->kho_ten}}</strong>
                </td>
                  <td colspan="3" class="caption" align="right" style="text-align: center; font-size: 12px">
                <i>Địa chỉ kho nhập: </i><strong>{{$pnk->khohang->kho_diachi}}</strong>
                </td>
               
            </tr>
             <tr>
                <td colspan="3" class="caption" align="left" style="text-align: center; font-size: 12px">
                <i>Nhà cung cấp: </i><strong>{{$pnk->nhacungcap->ncc_ten}}</strong>
                </td>
                  <td colspan="3" class="caption" align="right" style="text-align: center; font-size: 12px">
               <i>Địa chỉ nhà cung cấp: </i><strong> {{$pnk->nhacungcap->ncc_diachi}}</strong>
                </td>
               
            </tr>
            <tr style="border: 1px thin #000;">
                <th style="text-align: center">STT</th>
                <th style="text-align: center">Tên hàng hóa</th>
                <th style="text-align: center">Đơn vị tính</th>
                <th style="text-align: center">Nhóm hàng hóa</th>
                <th style="text-align: center">Số lượng</th>
                <th style="text-align: center">Đơn giá</th>
                 <th style="text-align: center">Thành tiền</th>
            </tr>
              <?php $i=1; 
                     $total=0;
                     ?>
          @foreach($ctpn as $key => $dsctpn)
            <tr style="border: 1px thin #000; " >
                <td align="center" valign="middle" width="5">
                   {{$i++}}
                </td>
                <td align="center" valign="middle" width="20" >
                   {{$dsctpn->hh_ten}}
                </td>
                <td align="left" valign="middle" width="30">
                  {{$dsctpn->hh_donvitinh}}
                </td>
                <td align="right" valign="middle" width="15">
                  {{$dsctpn->nhom_ten}}
                </td>
                <td align="right" valign="middle" width="15">
                  {{$dsctpn->ctpn_soluong}}
                </td>
                  <td align="right" valign="middle" width="15">
                    {{number_format($dsctpn->ctpn_dongia,0,',','.')}}
                  </td>
                    <td align="left" width="15" valign="middle">
                      {{number_format($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia,0,',','.')}}
                    </td>
               <?php
            $total=$total+($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia);
             ?>   
              
            </tr>
             @endforeach
               <tr align="center"> 
            <th style="text-align: center; font-size: 15px" colspan="6"><strong>Tổng tiền</strong></th>
            <th style="text-align:center;font-size:15px"><strong>{{ number_format($total,0,',',',') }}</strong></th>
            </tr>
             <tr></tr>
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
                 <i>Người lập phiếu</i>
                </td>
                 <td colspan="3" class="caption" align="center" style="text-align: center; font-size: 12px">
                 <i>Người giao hàng</i>
                </td>   
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
               <i>Thủ kho</i>
                </td>
               
            </tr>
        </table>
    </div>
</body>


</html>