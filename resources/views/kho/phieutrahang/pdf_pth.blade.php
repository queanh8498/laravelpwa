<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU KHÁCH TRẢ HÀNG-PTH00{{$pth->pth_id}}</title>
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
      <h1><center>PHIẾU KHÁCH TRẢ HÀNG</center></h1>
  <?php 
  $date=date("d-m-Y", strtotime($pth->pth_ngaylap));
 ?>
  <span><center>Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}</center></span> 
    <br>
    <table width=100%>
        <tr>
            <td><i>Khách trả hàng: </i><strong>{{$pth->dondathang->khachhang->kh_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ khách trả hàng: </i><strong> {{$pth->dondathang->khachhang->kh_diachi}}</strong></td>
        </tr>
        <tr>
           <td><i>Phiếu trả cho đơn hàng: </i><strong>DDH00{{$pth->ddh_id}}</strong></td>
        </tr>
    </table>
    
  <br>
 
  
            <table border="1" width=100%>
                <thead>
                    <tr>
                              <th>STT</th>
                             <th>Tên hàng hóa</th>
                              <th>Đơn vị tính</th>
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
          <tr align=center>
             <td> {{$i++}}</td>
            <td>{{$dsctpth->hh_ten}}</td>
            <td>{{$dsctpth->hh_donvitinh}}</td>
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
           
          </tbody>
      </table>
       <br/>
    <table align="right" width=50% cellpadding="5px" >
       
        <tr>
            <th>Tổng tiền:</th>
            <td>{{number_format($total,0,',','.')}} đ</td>
        </tr>
        <tr>
            <th>Giảm chiết khấu: </th>
            <td>  {{$pth->dondathang->ddh_giamchietkhau}}%</td>
        </tr>
        <tr>
            <th> Tiền nợ : </th>
            <td>{{number_format($pth->pth_tcn,0,',','.')}} đ</td>
        </tr>
        <tr>
            <th> Tiền nợ mới:</th>
            <td>{{number_format($pth->dondathang->ddh_congnomoi,0,',','.')}} đ</td>
        </tr>
         <tr>
            <th> Cần trả khách: </th>
            <td> {{number_format($pth->pth_ctk,0,',','.')}} đ</td>
        </tr>
       
    </table>
    <br/>
    <hr style="color: black; margin-top: 250px;" />
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