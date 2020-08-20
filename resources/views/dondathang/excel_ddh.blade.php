<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th colspan="9" style="font-size:18px; text-align:center">
                    <strong>THÔNG TIN ĐƠN HÀNG</strong>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ddh0 as $ddh)
                <tr></tr>
                <tr>
                    <th colspan="2" style="font-weight: bold;">Mã hóa đơn:</th>
                    <td colspan="2" style="text-align: left;">{{ $ddh->ddh_id }}</td>
                    <td></td>
                    <th colspan="2" style="font-weight: bold;">Trạng thái:</th>
                    <td colspan="2">
                        @if(($ddh->ddh_trangthai)==2)
                            {{ 'Có trả hàng ' }}
                        @else
                            {{ 'Đã giao hàng' }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th colspan="2" style="font-weight: bold;">Ngày lập:</th>
                    <td colspan="2">{{ $ddh->ddh_ngaylap }}</td>
                    <td></td>
                    <th colspan="2" style="font-weight: bold;">Nhân viên bán:</th>
                    <td colspan="2">{{ $ddh->name }}</td>
                </tr>
                <tr>
                    <th colspan="2" style="font-weight: bold;">Khách hàng:</th>
                    <td colspan="2">{{ $ddh->kh_ten }}</td>
                    <td></td>
                    <th colspan="2" style="font-weight: bold;">SĐT:</th>
                    <td colspan="2">{{ $ddh->kh_sdt }}</td>
                </tr>
                <tr>
                    <th colspan="2" style="font-weight: bold;">Công nợ cũ:</th>
                    <td colspan="2">{{ number_format($ddh->ddh_congnocu, 0, ',' , ',') }} VND</td>
                    <td></td>
                    <th colspan="2" style="font-weight: bold;">Ngày cho nợ:</th>
                    <td colspan="2">{{ $ddh->bccn_hanno }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table_1">
        <thead>
            <tr>
                <th style="font-weight: bold; text-align: center;">Mã HH</th>
                <th colspan="2" style="font-weight: bold; text-align: center;">Tên HH</th>
                <th colspan="2" style="font-weight: bold; text-align: center;">Số lượng</th>
                <th colspan="2" style="font-weight: bold; text-align: center;">Giá sản phẩm</th>
                <th colspan="2" style="font-weight: bold; text-align: center;">Thành tiền</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($ddh1 as $ddh1)
                <tr>       
                    <td style="text-align: center;">{{ $ddh1->hh_id }}</td>
                    <td colspan="2" style="text-align: center;">{{ $ddh1->hh_ten }}</td>
                    <td colspan="2" style="text-align: center;">{{ $ddh1->ctdh_soluong }}</td>
                    <td colspan="2" style="text-align: center;">{{ number_format($ddh1->ctdh_dongia, 0, ',' , ',') }}</td>
                    <td colspan="2" style="text-align: center;">{{ number_format($ddh1->TongTien, 0, ',' , ',') }}</td>    
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <table class="table_2">
        @foreach ($ddh2 as $ddh2)
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Tổng số lượng: </td>
                <td colspan="2">{{ $ddh2->TongSoLuong }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Tổng tiền hàng: </td>
                <td colspan="2" style="text-align: right;">{{ number_format($ddh2->TongTienHang, 0, ',' , ',') }} VND</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Chiết khấu (%): </td>
                <td colspan="2">{{ $ddh2->ddh_giamchietkhau }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Tổng cộng: </td>
                <td colspan="2" style="text-align: right;">{{ number_format($ddh2->TongCong, 0, ',' , ',') }} VND</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Khách đã trả: </td>
                <td colspan="2" style="text-align: right;">{{ number_format($ddh2->ddh_datra, 0, ',' , ',') }} VND</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="font-weight: bold;">Còn lại: </td>
                <td colspan="2" style="text-align: right;">{{ number_format($ddh2->ConLai, 0, ',' , ',') }} VND</td>
            </tr>
        @endforeach
    </table>
</body>
</html>
