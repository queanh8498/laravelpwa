<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phiếu lưu ký nhận - Đơn hàng {{$chitiet_kh->ddh_id}}</title>
    <style>
    
        body{
            font-family: DejaVu Sans, sans-serif;
        }
        .table_1, .table_2, .tieude{
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
        .phieuluukynhan{
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin-bottom: 5px;
            padding-left: 134px;
        }
        .ma_don{
            text-align: right;
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
    </style>
</head>
<body>

    <?php 
        $date_0=date("m.y", strtotime($chitiet_kh->ddh_ngaylap));
    ?>
    <table class="tieude">
        <tr>
            <td class="phieuluukynhan">PHIẾU LƯU KÝ NHẬN</td>
            <td class="ma_don">Số: <span style="text-decoration: underline;"><span style="font-weight: bold;">&nbsp;{{$chitiet_kh->ddh_id}} /&nbsp;</span><span>{{ $date_0 }}</span></span></td>
        </tr>
    </table>
    <?php 
        $date=date("d/m/Y", strtotime($chitiet_kh->ddh_ngaylap));
    ?>
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span> 
    <br>
    
    <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{$chitiet_kh->kh_ten}}</strong></td>
            <td style="text-align: right;">Địa chỉ: {{$chitiet_kh->kh_diachi}}</td>

        </tr>
    </table>
    <br>
    <table class="table_1">
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
                <td style="text-align: left;">{{ $ct->hh_ten }}</td>
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
    <table align="left" width=100% cellpadding="5px">
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
