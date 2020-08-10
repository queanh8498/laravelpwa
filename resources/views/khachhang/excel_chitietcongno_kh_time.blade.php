<table>
    <thead>
        <tr>
            <th colspan="6" style="font-size:20px;text-align:center">
                <strong>PHIẾU CHI TIẾT CÔNG NỢ THEO THỜI GIAN</strong>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr></tr>
        <tr>
        <?php
        $from_date=date("d-m-Y", strtotime($from_date));
        $to_date=date("d-m-Y", strtotime($to_date));
        ?>
        <td colspan="2"><strong>Từ ngày:</strong>{{ $from_date }}</td>
        <td></td>
        <td></td>
        <td colspan="2"><strong>Đến ngày:</strong>{{ $to_date }}</td>
        </tr>
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
                <th style="width:8px"><strong>STT</strong></th>
                <th style="text-align:center;width:15px"><strong>Số chứng từ</strong></th>
                <th style="text-align:center;width:15px"><strong>Ngày mua</strong></th>
                <th style="text-align:center;width:15px"><strong>Ngày tới hạn</strong></th>
                <th style="text-align:center;width:15px"><strong>Trạng thái</strong></th>
                <th style="text-align:center;width:40px"><strong>Nợ đơn (VND)</strong></th>
            </tr>
        </thead> 
        <tbody>
            <?php 
                $i=1; 
                $sum=0;
            ?>
            @foreach($chitiet_kh_date as $key => $chitiet_kh_date)
            <tr align=center>
                <td style="text-align:center">{{ $i++ }}</td>
                <td style="text-align:center">{{ $chitiet_kh_date->ddh_id }}</td>
                <?php 
                $date=date("d-m-Y", strtotime($chitiet_kh_date->ddh_ngaylap ));
                ?>
                <td style="text-align:center">{{ $date }}</td>
                <?php 
                $hanno=date("d-m-Y", strtotime($chitiet_kh_date->bccn_hanno ));
                ?>
                <td style="text-align:center">{{ $hanno }}</td>
                 <!-- Nếu congnomoi=0 tức là đơn hàng đó đã trả -->
                 @if ($chitiet_kh_date->ddh_congnomoi == 0)
                        <td style="text-align:center">Đã trả</td>
                    @else
                    @if ($current_day < $chitiet_kh_date->bccn_hanno )
                        @if ($current_day_add >= $chitiet_kh_date->bccn_hanno )
                            <td style="text-align:center">Sắp tới hạn
                            </td>
                        @else
                            <td style="text-align:center">
                            Còn nợ
                            </td>
                        @endif
                    @elseif($current_day > $chitiet_kh_date->bccn_hanno)
                        <td style="text-align:center">Qúa hạn
                        </td>
                    @elseif($current_day == $chitiet_kh_date->bccn_hanno)
                    <td style="text-align:center">Tới hạn
                    </td>
                    @endif
                    @endif
                    <!-- end -->

                <?php $sum += $chitiet_kh_date->bccn_soducongno; ?>
                <td style="text-align:center">{{ number_format($chitiet_kh_date->bccn_soducongno,0,',',',') }}</td>
            </tr>
            @endforeach
            <tr align="center"> 
            <th style="text-align:center;font-size:15px" colspan="5"><strong>Tổng nợ</strong></th>
            <th style="text-align:center;font-size:15px"><strong>{{ number_format($sum,0,',',',') }}</strong></th>
            </tr>

        </tbody>
    </table>
 