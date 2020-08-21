<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
            <th colspan="10" style="font-size:18px; text-align:center; font-weight: bold;">ĐƠN HÀNG THEO THỜI GIAN</th>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <?php
                $from_date=date("d-m-Y", strtotime($from_date));
                $to_date=date("d-m-Y", strtotime($to_date));
            ?>
            <td></td>
            <td></td>
            <td colspan="2"><strong>Từ ngày:</strong>{{ $from_date }}</td>
            <td></td>
            <td></td>
            <td></td>
            <td colspan="2"><strong>Đến ngày:</strong>{{ $to_date }}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th style="text-align: center; width:4px; font-weight: bold;">STT</th>
            <th style="text-align: center; width:8px; font-weight: bold;">Mã đơn</th>
            <th style="text-align: center; width: 15px; font-weight: bold;">Tên khách hàng</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Ngày lập</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Tổng tiền</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Khách đã trả</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Công nợ cũ</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Công nợ mới</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Tổng nợ</th>
            <th style="text-align: center; width: 12px; font-weight: bold;">Ngày cho nợ</th>
        </tr>
        <?php
            $i = 1;
        ?>
        @foreach($chitiet_ddh_date as $chitiet_ddh_date)
        <?php
             $ddh_ngaylap=date("d-m-Y", strtotime($chitiet_ddh_date->ddh_ngaylap));
        ?>
        <tr>
            <td style="text-align: center; width:4px;">{{ $i++ }}</td>
            <td style="text-align: center; width:12px;">DH00{{ $chitiet_ddh_date->ddh_id}}</td>
            <td style="text-align: left; width:15px;">{{ $chitiet_ddh_date->kh_ten}}</td>
            <td style="text-align: right; width:12px;">{{ $ddh_ngaylap}}</td>
            <td style="text-align: right; width:12px;">{{ number_format($chitiet_ddh_date->TongCong, 0, ',' , ',') }}</td>
            <td style="text-align: right; width:12px;">{{ number_format($chitiet_ddh_date->ddh_datra, 0, ',' , ',') }}</td>
            <td style="text-align: right; width:12px;">{{ number_format($chitiet_ddh_date->ddh_congnocu, 0, ',' , ',') }}</td>
            <td style="text-align: right; width:12px;">{{ number_format($chitiet_ddh_date->ddh_congnomoi, 0, ',' , ',') }}</td>
            <td style="text-align: right; width:12px;">{{ number_format($chitiet_ddh_date->ddh_congnocu + $chitiet_ddh_date->ddh_congnomoi, 0, ',' , ',') }}</td>
            <td style="text-align: right; width:12px;">{{ $chitiet_ddh_date->bccn_hanno }}</td>
        </tr>
        @endforeach
    </table>
</body>
</html>