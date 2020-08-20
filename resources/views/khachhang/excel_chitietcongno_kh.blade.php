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
            <th colspan="8" style="font-size:20px;text-align:center">
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
                <th rowspan="2" style="text-align:center;width:15px"><strong>Tổng tiền (VND)</strong></th>
               <th colspan="2" style="text-align:center;width:50px"><strong>Số tiền (VND)</strong></th>
               <th rowspan="2" style="text-align:center;width:15px"><strong>Trả hàng</strong></th>
               <th rowspan="2" style="text-align:center;width:20px"><strong>Nợ</strong></th>

            </tr>
            <tr>
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
                
                <?php $no = $chitiet_kh->tongtien-$chitiet_kh->ddh_datra;?>

                <td style="text-align:center">{{ number_format($no,0,',',',') }}</td>

                 <!-- có trả hàng thì hiện ra giá trị trả  -->
                 @if ($chitiet_kh->giatri_trahang == NULL)
                    <td style="text-align:center">0</td>
                @else
                    <td style="text-align:center">{{ number_format($chitiet_kh->giatri_trahang,0,',',',') }}</td>
                @endif
                <?php $no_after_trahang = $no - $chitiet_kh->giatri_trahang?>
                <td style="text-align:center">{{ number_format($no_after_trahang,0,',',',') }} </td>

                <!-- sum là tổng nợ đc tính sau khi khách trả hàng -->
                <?php $sum += $no_after_trahang; ?>

            </tr>
            @endforeach
            <tr style="border: 1px thin #000" align="center"> 
                <th style="font-size:13px" colspan="7"><strong>Tổng nợ</strong></th>
                <th style="text-align:center;font-size:13px"><strong>{{ number_format($sum,0,',',',') }}</strong></th>
            </tr>

            <tr style="border: 1px thin #000" align="center">
            @foreach($dathu_tongno_kh as $dathu_tongno_kh)
                <th style="text-align:center;font-size:13px" colspan="7"><strong>Đã thu:</strong></th>
                <th style="text-align:center;font-size:13px"><strong>{{ number_format($dathu_tongno_kh->tongthu_kh,0,',',',') }}</strong></th>
            </tr>

            @if ($chitiet_kh->giatri_trahang == NULL)
                @else
                <tr style="border: 1px thin #000" align="center">
                    <th style="text-align:center;font-size:13px" colspan="7"><strong>Tiền trả lại khách:</strong></th>
                    <?php $tralaikhach = abs($sum - $dathu_tongno_kh->tongthu_kh) ; ?>
                    <th style="text-align:center;font-size:13px"><strong>{{ number_format($tralaikhach,0,',',',') }}</strong></th>
                </tr>
                @endif

             <tr style="border: 1px thin #000" align="center">
            <th style="text-align:center;font-size:13px" colspan="7"><strong>Nợ hiện tại:</strong></th>
            <th style="text-align:center;font-size:13px"><strong>{{ number_format($dathu_tongno_kh->tongno,0,',',',') }}</strong></th>

            @endforeach
            </tr>
            

        </tbody>
    </table>
 