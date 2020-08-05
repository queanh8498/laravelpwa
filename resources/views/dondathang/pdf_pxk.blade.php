<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Phiếu xuất kho </title>
    
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
    <h1><center>PHIẾU XUẤT KHO</center></h1>
   
    <?php 
        $date=date("d/m/Y", strtotime($pxk->ddh_ngaylap));
    ?>
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date }}</center></span>
   
    <br>  
    <table width=100%>
        <tr>
            <td><i>Khách hàng: </i><strong>{{ $pxk->kh_ten }}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ: </i><strong>{{$pxk->kh_diachi}}</strong></td>
        </tr>
    </table>

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
            @foreach($chitiet_pxk as $key => $chitiet_pxk)
            <tr align=center>
                <td>{{ $i++ }}</td>
                <td>{{ $chitiet_pxk->hh_ten }}</td>
                <td>{{ $chitiet_pxk->hh_donvitinh }}</td>
                <td>{{ 1 }}</td>
                <td>{{ $chitiet_pxk->ctpx_soluong}}</td>
                <td>{{ number_format($chitiet_pxk->ctpx_dongia,0,',',',') }} đ</td>
                <td>{{ number_format($chitiet_pxk->ctpx_soluong * $chitiet_pxk->ctpx_dongia, 0,',',',') }} đ</td>
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
    <!-- <h4 style="text-align: right; margin-right: 50px;">Người lập phiếu</h4> -->
    <table width=100%>
        <tr>
            <td width=30%></td>
            <th width=35%>NV giao hàng</th>
            <th width=35%>Người lập phiếu</th>
        </tr>
    </table>
    <br>
    <br>
    <h4 style="text-align: right; margin-right: 30px;">{{ $ddh->user->name }}</h4>
</body>
</html>