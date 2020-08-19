<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU KHÁCH TRẢ HÀNG</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<?php 
  $date=date("d-m-Y", strtotime($pth->pth_ngaylap));
 ?>
 <body>
 <table>
    <thead>
        <tr>
            <th colspan="8" style="font-size:20px;text-align:center">
                <strong>PHIẾU KHÁCH TRẢ HÀNG</strong>
            </th>
        </tr>
        <tr>
            <th colspan="8" style="font-size:16px;text-align:center">
                 Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}
            </th>
        </tr>
    </thead>
    <tbody>
  
        <tr>
        <td colspan="4"> <i>Khách trả hàng: </i><strong>{{$pth->dondathang->khachhang->kh_ten}}</strong></td>
        <td></td>
        
        <td colspan="3"> <i>Địa chỉ khách trả hàng: </i><strong> {{$pth->dondathang->khachhang->kh_diachi}}</strong></td>
        </tr>
        <tr>
        <td colspan="4"> <i>Phiếu trả cho đơn hàng: </i><strong>DDH00{{$pth->ddh_id}}</strong></td>
        <td></td>
        <td></td>
        </tr>
      
        
    </tbody>
</table>
 <table border="1" width=100% >
        <thead>
           <tr>
                <th style="text-align: center;width:5px">STT</th>
                <th style="text-align: center;width:12px">Tên hàng hóa</th>
                <th style="text-align: center;width:10px">Đơn vị tính</th>
                <th style="text-align: center;width:12px">Nhà cung cấp</th>
                <th style="text-align: center;width:15px">Nhóm hàng hóa</th>
                <th style="text-align: center;width:8px">Số lượng</th>
                <th style="text-align: center;width:10px">Đơn giá</th>
                <th style="text-align: center;width:15px">Thành tiền</th>
           </tr>
        </thead> 
        <tbody>
          <?php $i=1; 
                     $total=0;
                     ?>
                @foreach($ctth as $key => $dsctpth)
            <tr  style="border: 1px thin #000" align=center >
                <td style="text-align:center;width:5px">
                   {{$i++}}
                </td>
                <td style="text-align:center;width:12px" >
                   {{$dsctpth->hh_ten}}
                </td>
                <td style="text-align:center;width:10px">
                 {{$dsctpth->hh_donvitinh}}
                </td>
                <td style="text-align:center;width:12px">
                   {{$dsctpth->ncc_ten}}
                </td>
                <td style="text-align:center;width:15px">
                  {{$dsctpth->nhom_ten}}
                </td>
                 <td style="text-align:center;width:8px">
                    {{$dsctpth->ctth_soluong}}
                </td>
               
                  <td style="text-align:center;width:10px">
                      {{number_format($dsctpth->ctth_dongia,0,',','.')}}
                  </td>
                    <td style="text-align:center;width:15px">
                      {{number_format($dsctpth->ctth_soluong*$dsctpth->ctth_dongia,0,',','.')}}
                    </td>
                 <?php
            $total=$total+($dsctpth->ctth_soluong*$dsctpth->ctth_dongia);
             ?>   
              
            </tr>
             @endforeach

        </tbody>
    </table>
    <table>
     <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Tổng tiền: </strong>
                </td>
                 <td align="center" width="15" valign="middle">
                     {{number_format($total,0,',','.')}}
                    </td>
            </tr>
            <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Giảm chiết khấu: </strong>
                </td>
                 <td align="center" width="15" valign="middle">
                      {{$pth->dondathang->ddh_giamchietkhau}}
                    </td>
            </tr>
                <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Tiền trả hàng:</strong>
                </td>
                 <td align="center" width="15" valign="middle">
                     {{number_format($total-$total*(($pth->dondathang->ddh_giamchietkhau)/100),0,',','.')}}
                    </td>
            </tr>
             <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Tiền cũ:</strong>
                </td>
                 <td align="center" width="15" valign="middle">
                     {{number_format($pth->pth_tcn,0,',','.')}}
                    </td>
            </tr>
             <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
                 <?php
 $cnkh=DB::table('congno_khachhang')->where('kh_id',$pth->dondathang->khachhang->kh_id)->first();
        ?>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Còn lại:</strong>
                </td>
                 <td align="center" width="15" valign="middle">
                      {{number_format($cnkh->tongno,0,',','.')}}
                    </td>
            </tr>
             <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td colspan="2" class="caption" align="center" style="text-align: center; font-size: 12px">
                <strong>Cần trả khách:</strong>
                </td>
                 <td align="center" width="15" valign="middle">
                    {{number_format($pth->pth_ctk,0,',','.')}}
                    </td>
            </tr>
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
                <td>
                </td>
                 <td>
                </td>   
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
               <strong>Khách trả hàng</strong>
                </td>
               
            </tr>
        </table>
    



</html>