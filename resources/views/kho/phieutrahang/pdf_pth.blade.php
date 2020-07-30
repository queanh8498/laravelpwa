<!DOCTYPE html>
<html>
<head>
    <title>Phiếu khách trả hàng-PTH00{{$pth->pth_id}}</title>
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
   <h1><center>Phiếu khách trả hàng</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
 <?php 
  $date=date("d-m-Y", strtotime($pth->pth_ngaylap));
 ?>
  <h5><center>Ngày lập: {{$date}}</center></h5>
  <p>Tên nhân viên lập phiếu: {{$pth->User->name}}</p>
  <p>Mã phiếu khách trả hàng: PTH00{{$pth->pth_id}}</p>
  <p>Khách trả hàng: {{$pth->dondathang->khachhang->kh_ten}}</p>
  <p>Địa chỉ khách trả hàng: {{$pth->dondathang->khachhang->kh_diachi}}</p>
  <p>Phiếu trả cho đơn hàng: DDH00{{$pth->ddh_id}}</p>
  <br>
  
            <table class="table-styling">
                <thead>
                    <tr>
                              <th>STT</th>
                             <th>Tên hàng hóa</th>
                              <th>Nhà cung cấp</th>
                              <th>Nhóm hàng hóa</th>
                              <th>Số lượng</th>
                              <th width="12%">Đơn giá</th>
                              <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
        <?php $i=1;$total=0; ?>
          @foreach($ctth as $key => $dsctpth)
          <tr>
             <td> {{$i++}}</td>
            <td>{{$dsctpth->hh_ten}}</td>
            <td>{{$dsctpth->ncc_ten}}</td>
            <td>{{$dsctpth->nhom_ten}}</td>
            <td>{{$dsctpth->ctth_soluong}}</td>
            <td>{{number_format($dsctpth->ctth_dongia,0,',','.')}}</td>
            <td>{{number_format($dsctpth->ctth_soluong*$dsctpth->ctth_dongia,0,',','.')}}</td>
            <?php
            $total=$total+($dsctpth->ctth_soluong*$dsctpth->ctth_dongia);
             ?>
          </tr>
          @endforeach
          <tr>
                <td colspan="7">
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
                        <th width="800px">Khách trả hàng</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            
        </table>      
</body>
</html>