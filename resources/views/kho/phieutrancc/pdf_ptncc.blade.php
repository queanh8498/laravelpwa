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
  <?php 
  $date=date("d-m-Y", strtotime($ptncc->ptncc_ngaylap));
 ?>
  <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span> 
    <br>
    <table width=100%>
        <tr>
            <td><i>Nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_diachi}}</strong></td>
        </tr>
        <tr>
           <td><i>Tạo bởi phiếu nhập: </i><strong>PNK00{{$ptncc->pnk_id}}</strong></td>
        </tr>
    </table>
    
  <br>

  
            <table border="1" width=100%>
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
          <tr align=center>
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
     <hr style="color: black; margin-top: 150px;" />

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