<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<style>
    table {
        border: 1px solid #000;
    }
    tr > td {
    border-bottom: 1px solid #000000;
}
</style>

<table>
    <thead>
        <tr>
            <th colspan="6" style="font-size:20px;text-align:center">
                <strong>PHIẾU CHI TIẾT CÔNG NỢ</strong>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr></tr>
        <tr>
        <td colspan="2"><strong>Khách hàng:</strong></td>
        <td colspan="3">{{$kh->kh_ten}} </td>
        </tr>
        <tr>
        <td colspan="2"><strong>Địa chỉ:</strong></td>
        <td colspan="3">{{$kh->kh_diachi}} </td>
        </tr>
        <tr>
        <td colspan="2"><strong>Số điện thoại:</strong></td>
        <td colspan="3">{{$kh->kh_sdt}}</td>
        </tr>
        
    </tbody>
</table>
    <table border="1" width=100% >
        <thead>
            <tr>
                <th rowspan="2" style="width:5px"><strong>STT</strong></th>
                <th rowspan="2" style="text-align:center;width:15px"><strong>Ngày mua</strong></th>
                <th rowspan="2" style="text-align:center;width:15px"><strong>Số chứng từ</strong></th>
               <th colspan="3" style="text-align:center;width:50px"><strong>Số tiền (VND)</strong></th>
            </tr>
            <tr>
                <th  style="text-align:center;width:15px"><strong>Tổng tiền</strong></th>
                <th  style="text-align:center;width:15px"><strong>Đã trả</strong></th>
                <th  style="text-align:center;width:20px"><strong>Nợ</strong></th>
            </tr>
        </thead> 
        <tbody>
            <?php 
                $i=1; 
                $sum=0;
            ?>
            @foreach($chitiet_kh as $key => $chitiet_kh)
            <tr style="border: 1px thin #000" align=center>
                <td style="text-align:center">{{ $i++ }}</td>
                <?php 
                $date=date("d-m-Y", strtotime($chitiet_kh->ddh_ngaylap ));
                ?>
                <td style="text-align:center">{{ $date }}</td>
                <td style="text-align:center">{{ $chitiet_kh->ddh_id }}</td>
                <td style="text-align:center">{{ number_format($chitiet_kh->tongtien,0,',',',') }}</td>
                <td style="text-align:center">{{ number_format($chitiet_kh->ddh_datra,0,',',',') }}</td>
                <?php $sum += $chitiet_kh->bccn_soducongno; ?>
                <td style="text-align:center">{{ number_format($chitiet_kh->bccn_soducongno,0,',',',') }}</td>
            </tr>
            @endforeach
            <tr style="border: 1px thin #000" align="center"> 
            <th style="font-size:15px" colspan="5"><strong>Tổng nợ</strong></th>
            <th style="text-align:center;font-size:15px"><strong>{{ number_format($sum,0,',',',') }}</strong></th>
            </tr>

        </tbody>
    </table>
 