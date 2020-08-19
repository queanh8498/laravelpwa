<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU KHÁCH TRẢ HÀNG-PTH00{{$pth->pth_id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
        .table_0, .table_1, .table_2, .tieude{
            border-collapse: collapse;
        }
        .tieude{
            /* border: 1px solid #000; */
            border: none;
            width: 100%;
        }
        /* .tieude td{
            border: 1px solid #000;
        } */
        .phieubanhang{
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin-bottom: 5px;
            padding-left: 134px;
        }
        .ma_don{
            text-align: right;
        }
        .table_0{
            width: 100%;
            border: none;
            margin-bottom: 10px;
        }
        .table_1{
            width: 100%;
            margin-top: 5px;
        }
        .table_1 th{
            border: 1px solid #000;
        }
        .table_1 td{
            border: 1px solid #000;
        }
        .table_2{
            border: none;
            width: 310px;
            margin-right: -80px;
        }
        .table_2 th{
            text-align: left;
        }
        .table_2 td{
            text-align: right;
        }
        .table_3{
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .table_3 th{
            text-align: center;
            /* border: 1px solid #000; */
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
 
  
            <table class="table_1">
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
            <th>Tiền trả hàng: </th>
            <td>{{number_format($total-$total*(($pth->dondathang->ddh_giamchietkhau)/100),0,',','.')}}đ</td>
        </tr>
        <tr>
            <th> Tiền cũ: </th>
            <td>{{number_format($pth->pth_tcn,0,',','.')}} đ</td>
        </tr>
        <?php
 $cnkh=DB::table('congno_khachhang')->where('kh_id',$pth->dondathang->khachhang->kh_id)->first();
        ?>
        <tr>
            <th> Còn lại:</th>
            <td>{{number_format($cnkh->tongno,0,',','.')}} đ</td>
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