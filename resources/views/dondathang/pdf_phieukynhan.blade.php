<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phiếu lưu ký nhận</title>
    <style>
    
        body{
            font-family: DejaVu Sans, sans-serif;
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
    <h1><center>PHIẾU LƯU KÝ NHẬN</center></h1>
    <span><center><i>Ngày lập: </i><strong><?php echo now();?></strong></center></span> 
    <br>

    <span><center><i>Khách hàng: </i><strong>{{$chitiet_kh->kh_ten}}</strong></center></span> 
    <span><center><i>Địa chỉ: </i><strong>{{$chitiet_kh->kh_diachi}}</strong></center></span> 
    <span><center><i>Số điện thoại: </i><strong>{{$chitiet_kh->kh_sdt}}</strong></center></span> 

    <br>
    
    <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{$chitiet_kh->kh_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{ $chitiet_kh->kh_diachi }}</strong></td>

        </tr>
    </table>
    <br>
    <table border="1" width=100%>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên hàng </th>
                <th>ĐVT</th>
                <th>Số lượng </th>
                <th>Đơn giá </th>
                <th>Thành tiền</th>
            </tr>
        </thead> 

        <tbody>
            <?php 
                $i=1; 
                $sum=0;
                $ck=0;
                $giam=0;
            ?>
            @foreach($chitiet_ddh as $key => $ct)
            <tr align=center>
                <td>{{ $i++ }}</td>
                <td>{{ $ct->hh_ten }}</td>
                <td>Gói</td>
                <td>{{ $ct->ctdh_soluong }}</td>
                <td>{{ number_format($ct->ctdh_dongia,0,',',',') }}</td>
                <td>{{ number_format($ct->tongtien,0,',',',') }}</td>

                <?php $sum += $ct->tongtien; ?>
                <?php $ck = $ct->ddh_giamchietkhau; ?>
            </tr>
            @endforeach
            <tr align=center>
            <td colspan="2">Tiền mặt giảm</td>
            <td>Đồng</td>
            <td>-1</td>
            <?php $giam = $ck*$sum/100; ?>
            <td>{{ number_format($giam,0,',',',') }} </td>
            <td>{{ number_format(-$giam,0,',',',') }} </td>
            </tr>
            <tr>
            <th colspan="5">Tổng tiền</th>
            <th>{{ number_format($sum - $giam,0,',',',') }}</th>
            </tr>

        </tbody>
    </table>
    <br>
   
    <br>
    <hr style="color: black; margin-top: 150px;" />
    <table align="left" width=110% cellpadding="5px">
       <tr>
       <th>Người nhận</th>
       <th>Người giao</th>
       <th>Người lập phiếu</th>
       </tr> 
    </table>
    <br>
    <h4 style="text-align: right; margin-right: 100px;"></h4>
</body>
</html>
