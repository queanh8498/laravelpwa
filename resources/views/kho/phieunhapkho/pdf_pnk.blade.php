<!DOCTYPE html>
<html>
<head>
    <title>Phiếu nhập kho-PNK00{{$pnk->pnk_id}}</title>
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
   <h1><center>Phiếu nhập kho</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
 <?php 

  $date=date("d-m-Y", strtotime($pnk->pnk_ngaynhapkho));
 ?>
  <h5><center>Ngày lập: {{$date}}</center></h5>
  <p>Tên nhân viên lập phiếu: {{$pnk->User->name}}</p>
  <p>Mã phiếu nhập: PNK00{{$pnk->pnk_id}}</p>
  <p>Kho nhập hàng: {{$pnk->khohang->kho_ten}}</p>
  <p>Địa chỉ: {{$pnk->khohang->kho_diachi}}</p>
  <p>Nhà cung cấp: {{$pnk->nhacungcap->ncc_ten}}</p>
  <br>
  
            <table class="table-styling">
                <thead>
                    <tr>
                            <th>STT</th>
                            <th>Tên hàng hóa</th>
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
          <tr>
            <td> {{$i++}}</td>
            <td>{{$dsctpn->hh_ten}}</td>
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
                <td colspan="6">
                    <p>Tổng tiền: {{number_format($total,0,',','.').' VNĐ'}}</p>
                </td>
        </tr>
          </tbody>
      </table>
      <p>------------------------------------------------------------------------------------------------------------------------</p>

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