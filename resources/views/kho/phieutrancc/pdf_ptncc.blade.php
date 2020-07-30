<!DOCTYPE html>
<html>
<head>
    <title>Phiếu trả nhà cung cấp-PTNCC00{{$ptncc->ptncc_id}}</title>
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
   <h1><center>Phiếu trả nhà cung cấp</center></h1>
 <h4><center>Sổ tiền mặt Tân Thành</center></h4>
 <?php 
  $date=date("d-m-Y", strtotime($ptncc->ptncc_ngaylap));
 ?>
  <h5><center>Ngày lập: {{$date}}</center></h5>
  <p>Tên nhân viên lập phiếu:{{$ptncc->User->name}}</p>
  <p>Mã phiếu trả nhà cung cấp: PTNCC00{{$ptncc->ptncc_id}}</p>
  <p>Nhà cung cấp: {{$ptncc->nhacungcap->ncc_ten}}</p>
  <p>Tạo bởi phiếu nhập: PNK00{{$ptncc->pnk_id}}</p>
  <br>
  
            <table class="table-styling">
                <thead>
                    <tr>
                               <th>STT</th>
                              <th>Tên hàng hóa</th>
                              <th>Số lượng</th>
                              <th width="12%">Đơn giá</th>
                              <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
        <?php $i=1;$total=0; ?>
          @foreach($ctncc as $key => $dsctptncc)
          <tr>
            <td>{{$i++}}</td>
            <td>{{$dsctptncc->hh_ten}}</td>
            <td>{{$dsctptncc->ctncc_soluong}}</td>
            <td>{{number_format($dsctptncc->ctncc_dongia,0,',','.') }}</td>
            <td>{{number_format($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia,0,',','.')}}</td>
            <?php
            $total=$total+($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia);
             ?>
          </tr>
          @endforeach
          <tr>
                <td colspan="5">
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
                        <th width="800px">Nhà cung cấp</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            
        </table>      
</body>
</html>