<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phiếu bán hàng {{$ddh->ddh_id}}</title>
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
    <h1><center>PHIẾU BÁN HÀNG</center></h1>
    <?php 
        $date=date("d/m/Y", strtotime($ddh->ddh_ngaylap));
    ?>
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span> 
    <br>
    
    <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{$ddh->khachhang->kh_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{$ddh->khachhang->kh_diachi}}</strong></td>
        </tr>
    </table>
    <i>*Hàng mua rồi miễn đổi trả lại</i><br><br>
    <table border="1" width=100%>
        <thead>
            <tr>
                <th>STT</th>
                <th>Tên hàng</th>
                <th>ĐVT</th>
                <th>Số Th/bao</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th>Tổng nợ</th>
            </tr>
        </thead> 

        <tbody>
            <?php 
                $i=1; 
                //$total=0;
            ?>
            @foreach($ctdh as $key => $dsctdh)
            <tr align=center>
                <td>{{ $i++ }}</td>
                <td>{{ $dsctdh->hh_ten }}</td>
                <td>{{ $dsctdh->hh_donvitinh }}</td>
                <td>{{ 1 }}</td>
                <td>{{ $dsctdh->ctdh_soluong}}</td>
                <td>{{ number_format($dsctdh->ctdh_dongia,0,',',',') }} đ</td>
                <td>{{ number_format($dsctdh->ctdh_soluong * $dsctdh->ctdh_dongia, 0,',',',') }} đ</td>
                <td>{{ 0 }}</td>
            </tr>
            @endforeach

            @foreach($ddh3 as $ddh3)
            <tr align=center>
                <td>{{ $i++ }}</td>
                <td>{{ 'Tiền mặt giảm' }}</td>
                <td>{{ 'Đồng' }}</td>
                <td></td>
                <td>{{ -1 }}</td>
                <td>{{ number_format($ddh3->TienGiamChietKhau,0,',',',') }} đ</td>          
                <td>{{ number_format(-$ddh3->TienGiamChietKhau,0,',',',') }} đ</td>
                <td>{{ 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table align="right" width=50% cellpadding="5px">
        @foreach($ddh2 as $ddh2)
        <tr>
            <th>Tổng cộng:</th>
            <td>{{ number_format($ddh2->TongCong, 0, ',' , ',') }} đ</td>
        </tr>
        <tr>
            <th>Tiền cũ:</th>
            <td>{{ number_format($ddh2->ddh_congnocu, 0, ',' , ',') }} đ</td>
        </tr>
        <tr>
            <th>Trả:</th>
            <td>{{ number_format($ddh2->ddh_datra, 0, ',' , ',') }} đ</td>
        </tr>
        <tr>
            <th>Còn lại:</th>
            <td>{{ number_format($ddh2->ConLai, 0, ',' , ',') }} đ</td>
        </tr>
        @endforeach
    </table>
    <br>
    <hr style="color: black; margin-top: 150px;" />
    <h4 style="text-align: right; margin-right: 120px;">Người lập phiếu</h4>
    <br>
    <h4 style="text-align: right; margin-right: 100px;">{{ $ddh->user->name }}</h4>
</body>
</html>
