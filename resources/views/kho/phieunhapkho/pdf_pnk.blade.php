<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU NHẬP KHO-PNK00{{$pnk->pnk_id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>body{
            font-family: DejaVu Sans;
        }
        .table-styling{
            border:1px solid #000;
        }
        .table-styling tbody tr td{
            border:1px solid #000;
        }
        </style>
</head>
<body>
   <h1><center>PHIẾU NHẬP KHO</center></h1>
 <?php 

  $date=date("d-m-Y", strtotime($pnk->pnk_ngaynhapkho));
 ?>
  <span><center>Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}</center></span> 
    <br>
    <table width=100%>
        <tr>
            <td><i>Kho nhập: </i><strong>{{$pnk->khohang->kho_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ kho nhập: </i><strong>{{$pnk->khohang->kho_diachi}}</strong></td>
        </tr>
        <tr>
           <td><i>Nhà cung cấp: </i><strong>{{$pnk->nhacungcap->ncc_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ nhà cung cấp: </i><strong> {{$pnk->nhacungcap->ncc_diachi}}</strong></td>
        </tr>
    </table>
    
  <br>
  
            <table border="1" width=100%>
                <thead>
                    <tr>
                            <th>STT</th>
                            <th>Tên hàng hóa</th>
                             <th>Đơn vị tính</th>
                            <th>Nhóm hàng hóa</th>
                            <th>Số lượng</th>
                            <th width="12%">Đơn giá</th>
                            <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                     <?php $i=1; 
                     $total=0;
                     ?>
          @foreach($ctpn as $key => $dsctpn)
          <tr  align=center>
            <td> {{$i++}}</td>
            <td>{{$dsctpn->hh_ten}}</td>
               <td>{{$dsctpn->hh_donvitinh}}</td>
            <td>{{$dsctpn->nhom_ten}}</td>
            <td>{{$dsctpn->ctpn_soluong}}</td>
            <td>{{number_format($dsctpn->ctpn_dongia,0,',','.')}}</td>
            <td>{{number_format($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia,0,',','.')}}</td>
            <?php
            $total=$total+($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia);
             ?>
          </tr>
          @endforeach
         
         <tr>
            <th colspan="6">Tổng tiền</th>
            <th>{{number_format($total,0,',','.') }}</th>
            </tr>
          </tbody>
      </table>
      <hr style="color: black; margin-top: 150px;" />

          <table>
                <thead>
                    <tr>
                        <th width="200px">Người lập phiếu</th>
                        <th width="250px">Người giao hàng</th>
                        <th width="250px">Thủ kho</th>
                        
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
            
        </table>      
</body>
</html>