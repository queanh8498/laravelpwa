<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phiếu bán hàng {{$ddh->ddh_id}}</title>
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
    <?php 
        $date_0=date("m.y", strtotime($ddh->ddh_ngaylap));
    ?>
    <table class="tieude">
        <tr>
            <td class="phieubanhang">PHIẾU BÁN HÀNG</td>
            <td class="ma_don">Số: <span style="text-decoration: underline;"><span style="font-weight: bold;">&nbsp;{{$ddh->ddh_id}} /&nbsp;</span><span>{{ $date_0 }}</span></span></td>
        </tr>
    </table>
    <?php 
        $date=date("d/m/Y", strtotime($ddh->ddh_ngaylap));
    ?>
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span> 
    <br>
    
    <table class="table_0">
        <tr>
            <td><i>Khách hàng: </i><strong>{{$ddh->khachhang->kh_ten}}</strong></td>
            <td style="text-align: right;">Địa chỉ: {{$ddh->khachhang->kh_diachi}}</td>
        </tr>
    </table>

    <i>*Hàng mua rồi miễn đổi trả lại</i><br>

    <table class="table_1">
        <thead>
            <tr>
                <th width=5%>STT</th>
                <th width=20%>Tên hàng</th>
                <th width=7%>ĐVT</th>
                <th width=8%>Số Th/bao</th>
                <th width=10%>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
                <th width=7%>Tg.Nợ</th>
            </tr>
        </thead> 

        <tbody>
            <?php 
                $i=1; 
                //$total=0;
            ?>
            @foreach($ctdh as $key => $dsctdh)
            <tr>
                <td style="text-align: center;">{{ $i++ }}</td>
                <td>{{ $dsctdh->hh_ten }}</td>
                <td style="text-align: center;">{{ $dsctdh->hh_donvitinh }}</td>
                <td style="text-align: right;">{{ 1 }}</td>
                <td style="text-align: right;">{{ $dsctdh->ctdh_soluong}}</td>
                <td style="text-align: right;">{{ number_format($dsctdh->ctdh_dongia,0,',','.') }}</td>
                <td style="text-align: right;">{{ number_format($dsctdh->ctdh_soluong * $dsctdh->ctdh_dongia, 0,',','.') }}</td>
                <td style="text-align: right;">{{ 0 }}</td>
            </tr>
            @endforeach

            @foreach($ddh3 as $ddh3)
            <tr>
                <td style="text-align: center;">{{ $i++ }}</td>
                <td>{{ 'Tiền mặt giảm' }}</td>
                <td style="text-align: center;">{{ 'Đồng' }}</td>
                <td style="text-align: right;"></td>
                <td style="text-align: right;">{{ -1 }}</td>
                <td style="text-align: right;">{{ number_format($ddh3->TienGiamChietKhau,0,',','.') }}</td>          
                <td style="text-align: right;">{{ number_format(-$ddh3->TienGiamChietKhau,0,',','.') }}</td>
                <td style="text-align: right;">{{ 0 }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table_2" align="right">
        @foreach($ddh2 as $ddh2)
        <tr>
            <th>Tổng cộng:</th>
            <td>{{ number_format($ddh2->TongCong, 0, ',' , '.') }}</td>
        </tr>
        <tr>
            <th>Tiền cũ:</th>
            <td>{{ number_format($ddh2->ddh_congnocu, 0, ',' , '.') }}</td>
        </tr>
        <tr>
            <th>Trả:</th>
            <td>{{ number_format($ddh2->ddh_datra, 0, ',' , '.') }}</td>
        </tr>
        <tr>
            <th>Còn lại:</th>
            <td style="font-weight: bold;">{{ number_format($ddh2->ConLai, 0, ',' , '.') }}</td>
        </tr>
        @endforeach
    </table>
    <br>
    <hr style="color: black; margin-top: 105px;" />
    <table class="table_3">
        <tr>
            <th style="text-align: left;">Toa Bán Tiền Mặt</th>
            <th></th>
            <th width="350px;">Người lập phiếu</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <!-- <th style="padding-top: 100px; width: 270px; text-align: center;">{{ $ddh->user->name }}</th> -->
        </tr>
    </table>
</body>
</html>
