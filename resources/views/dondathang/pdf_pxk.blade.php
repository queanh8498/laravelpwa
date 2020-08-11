<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phiếu xuất kho {{$pxk->pxk_id}} - Đơn hàng {{$pxk->ddh_id}}</title>
    
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
        .phieuxuatkho{
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
            width: 100%;
            margin-top: 20px;
        }
        .table_2 th{
            text-align: right;
            /* border: 1px solid #000; */
        }
    </style>
</head>
<body>
    <?php 
        $date_0=date("m.y", strtotime($pxk->ddh_ngaylap));
    ?>
    <table class="tieude">
        <tr>
            <td class="phieuxuatkho">PHIẾU XUẤT KHO</td>
            <td class="ma_don">Số: <span style="text-decoration: underline;"><span style="font-weight: bold;">&nbsp;{{$pxk->pxk_id}} /&nbsp;</span><span>{{ $date_0 }}</span></span></td>
        </tr>
    </table>
    <?php 
        $date=date("d/m/Y", strtotime($pxk->ddh_ngaylap));
    ?>
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span> 

    <br><br>

    <table class="table_0">
        <tr>
            <td><i>Khách hàng: </i><strong>{{ $pxk->kh_ten }}</strong></td>
            <td style="text-align: right;">Địa chỉ: {{$pxk->kh_diachi}}</td>
        </tr>
    </table>

    <br>

    <table class="table_1">
        <thead>
            <tr>
                <th width=7%>STT</th>
                <th width=20%>Tên hàng</th>
                <th width=10%>ĐVT</th>
                <th width=10%>Số Th/bao</th>
                <th width=15%>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
        </thead> 

        <tbody>
            <?php 
                $i=1; 
                //$total=0;
            ?>
            @foreach($chitiet_pxk as $key => $chitiet_pxk)
            <tr>
                <td style="text-align: center;">{{ $i++ }}</td>
                <td>{{ $chitiet_pxk->hh_ten }}</td>
                <td style="text-align: center;">{{ $chitiet_pxk->hh_donvitinh }}</td>
                <td style="text-align: center;">{{ 1 }}</td>
                <td style="text-align: center;">{{ $chitiet_pxk->ctpx_soluong}}</td>
                <td style="text-align: right;">{{ number_format($chitiet_pxk->ctpx_dongia,0,',','.') }}</td>
                <td style="text-align: right;">{{ number_format($chitiet_pxk->ctpx_soluong * $chitiet_pxk->ctpx_dongia, 0,',','.') }}</td>
            </tr>
            @endforeach

            @foreach($ddh3 as $ddh3)
            <tr>
                <!-- <td style="text-align: center;">{{ $i++ }}</td> -->
                <td colspan="2" style="text-align: center;">{{ 'Tiền mặt giảm' }}</td>
                <td style="text-align: center;">{{ 'Đồng' }}</td>
                <td style="text-align: center;"></td>
                <td style="text-align: center;">{{ -1 }}</td>
                <td style="text-align: right;">{{ number_format($ddh3->TienGiamChietKhau,0,',','.') }}</td>          
                <td style="text-align: right;">{{ number_format(-$ddh3->TienGiamChietKhau,0,',','.') }}</td>
            </tr>
            <tr>
                <th colspan="6">Tổng tiền</th>
                <th style="text-align: right;">{{ number_format($ddh3->TongCong,0,',','.') }}</th>   
            </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <hr style="color: black; margin-top: 150px;" />
    <!-- <h4 style="text-align: right; margin-right: 50px;">Người lập phiếu</h4> -->
    <table class="table_2">
        <tr>
            <th></th>
            <th style="width: 250px; text-align: center;">NV giao hàng</th>
            <th style="width: 250px; text-align: center;">Người lập phiếu</th>
        </tr>
        <tr>
            <th></th>
            <th></th>
            <!-- <th style="padding-top: 100px; width: 270px; text-align: center;">{{ $ddh->user->name }}</th> -->
        </tr>
    </table>
</body>
</html>