<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU NHẬP KHO</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
    table {
        border: 1px solid #000;
    }
    tr > td {
    border-bottom: 1px solid #000000;
}
</style>
</head>
<?php 

  $date=date("d-m-Y", strtotime($pnk->pnk_ngaynhapkho));
 ?>
 <body>
 <table>
    <thead>
        <tr>
            <th colspan="7" style="font-size:20px;text-align:center">
                <strong>PHIẾU NHẬP KHO</strong>
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
        <td colspan="2"> <i>Kho nhập: </i><strong>{{$pnk->khohang->kho_ten}}</strong></td>
        <td></td>
        <td></td>
        <td colspan="3"> <i>Địa chỉ kho nhập: </i><strong>{{$pnk->khohang->kho_diachi}}</strong></td>
        </tr>
        <tr>
        <td colspan="2">  <i>Nhà cung cấp: </i><strong>{{$pnk->nhacungcap->ncc_ten}}</strong></td>
        <td></td>
        <td></td>
        <td colspan="3"> <i>Địa chỉ nhà cung cấp: </i><strong> {{$pnk->nhacungcap->ncc_diachi}}</strong></td>
        </tr>
      
        
    </tbody>
</table>
 <table border="1" width=100% >
        <thead>
           <tr>
                <th  style="text-align:center;width:5px">STT</th>
                <th  style="text-align:center;width:15px" >Tên hàng hóa</th>
                <th  style="text-align:center;width:10px">Đơn vị tính</th>
                <th  style="text-align:center;width:12px">Nhóm hàng hóa</th>
                <th  style="text-align:center;width:15px">Số lượng</th>
                <th  style="text-align:center;width:12px">Đơn giá</th>
                <th  style="text-align:center;width:18px">Thành tiền</th>
           </tr>
        </thead> 
        <tbody>
          <?php $i=1; 
                     $total=0;
                     ?>
          @foreach($ctpn as $key => $dsctpn)
            <tr  style="border: 1px thin #000" align=center >
                <td style="text-align:center;width:5px">
                   {{$i++}}
                </td>
                <td style="text-align:center;width:15px" >
                   {{$dsctpn->hh_ten}}
                </td>
                <td style="text-align:center;width:10px">
                  {{$dsctpn->hh_donvitinh}}
                </td>
                <td style="text-align:center;width:15px">
                  {{$dsctpn->nhom_ten}}
                </td>
                <td style="text-align:center;width:15px">
                  {{$dsctpn->ctpn_soluong}}
                </td>
                  <td style="text-align:center;width:12px">
                    {{number_format($dsctpn->ctpn_dongia,0,',','.')}}
                  </td>
                    <td style="text-align:center;width:18px">
                      {{number_format($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia,0,',','.')}}
                    </td>
               <?php
            $total=$total+($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia);
             ?>   
              
            </tr>
             @endforeach
            <tr style="border: 1px thin #000" align="center"> 
            <th style="font-size:15px" colspan="6"><strong>Tổng tiền</strong></th>
            <th style="text-align:center;font-size:18px"><strong>{{ number_format($total,0,',',',') }}</strong></th>
            </tr>

        </tbody>
    </table>
  <table>
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
                 <strong>Người lập phiếu</strong>
                </td>
                 <td colspan="3" class="caption" align="center" style="text-align: center; font-size: 12px">
                 <strong>Người giao hàng</strong>
                </td>   
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
               <strong>Thủ kho</strong>
                </td>
               
            </tr>
        </table>
    
</body>


</html>