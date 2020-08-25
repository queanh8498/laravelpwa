<table>
    <thead>
        <tr>
            <th colspan="10" style="font-size:20px;text-align:center">
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
        <td colspan="3"><strong>Từ ngày:</strong>{{ $from_date }}</td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td></td>
        <td colspan="3"><strong>Đến ngày:</strong>{{ $to_date }}</td>
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
                <th rowspan="2" style="width:5px"><strong>STT</strong></th>
                <th rowspan="2" style="text-align:center;width:13px"><strong>Số chứng từ</strong></th>
                <th rowspan="2" style="text-align:center;width:11px"><strong>Ngày mua</strong></th>
                <th rowspan="2" style="text-align:center;width:13px"><strong>Ngày tới hạn</strong></th>
                <th colspan="3" style="text-align:center;width:13px"><strong>Số tiền (VND)</strong></th>
                <th rowspan="2" style="text-align:center;width:13px"><strong>Trả hàng</strong></th>
                <th rowspan="2" style="text-align:center;width:13px"><strong>Tổng nợ đơn</strong></th>
                <th rowspan="2" style="text-align:center;width:13px"><strong>Trạng thái</strong></th>
            </tr>
            <tr>
                <th  style="text-align:center;width:13px"><strong>Tổng tiền</strong></th>
                <th  style="text-align:center;width:13px"><strong>Đã trả</strong></th>
                <th  style="text-align:center;width:13px"><strong>Nợ</strong></th>
            </tr>
        </thead> 
        <tbody>
            <?php 
                $i=1; 
                $sum=0;
                $tralaikhach=0;
            ?>
            @foreach($chitiet_kh_date as $key => $chitiet_kh_date)
            <tr align=center>
                <td style="text-align:center">{{ $i++ }}</td>
                <td style="text-align:center">DH00{{ $chitiet_kh_date->ddh_id }}</td>
                <?php 
                $date=date("d-m-Y", strtotime($chitiet_kh_date->ddh_ngaylap ));
                ?>
                <td style="text-align:center">{{ $date }}</td>
                <?php 
                $hanno=date("d-m-Y", strtotime($chitiet_kh_date->bccn_hanno ));
                ?>
                <td style="text-align:center">{{ $hanno }}</td>
                <td style="text-align:center">{{ number_format($chitiet_kh_date->tongtien,0,',',',') }}</td>
                <td style="text-align:center">{{ number_format($chitiet_kh_date->ddh_datra,0,',',',') }}</td>
                
                <?php $no = $chitiet_kh_date->tongtien-$chitiet_kh_date->ddh_datra;?>
                <td  style="text-align:center">{{ number_format($no,0,',',',') }}</td>

                @if ($chitiet_kh_date->giatri_trahang == NULL)
                    <td  style="text-align:center">0</td>
                @else
                    <td  style="text-align:center">{{ number_format($chitiet_kh_date->giatri_trahang,0,',',',') }}</td>
                @endif
                <?php $no_after_trahang_1 = $no - $chitiet_kh_date->giatri_trahang;
                    $no_after_trahang_2 = $no - $chitiet_kh_date->giatri_trahang;
                    // if ($no_after_trahang_1 < 0){
                    //     $no_after_trahang_1=0;
                    // }
                ?>
                <td  style="text-align:center">{{ number_format($no_after_trahang_1,0,',',',') }} </td>

                     <!-- sum là tổng nợ đc tính sau khi khách trả hàng -->
                     <?php $sum += $no_after_trahang_1; ?>


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
                    <td></td>
                    <!-- end -->
                    <?php $tralaikhach += $chitiet_kh_date->pth_ctk; ?>

            </tr>
            @endforeach
            <tr align="center"> 
            <th style="text-align:center;font-size:12px" colspan="8"><strong>Tổng nợ Đơn hàng</strong></th>
            <th style="font-size:12px" colspan="2"><strong>{{ number_format($sum,0,',',',') }}</strong></th>
            </tr>
           
            <tr> 
            @foreach($dathu_tongno_kh_date as $key => $dathu_tongno_kh_date)    
            <th style="text-align:center;font-size:12px" colspan="8"><strong>Đã thu</strong></th>
            <th style="text-align:left;font-size:12px" colspan="2"><strong>{{ number_format($dathu_tongno_kh_date->tongthu_kh,0,',',',') }}</strong></th>
            </tr>

            <tr align="center"> 
            <th style="text-align:center;font-size:12px" colspan="8"><strong>Tiền trả khách</strong></th>
            <th style="text-align:left;font-size:12px" colspan="2"><strong>{{ number_format($tralaikhach,0,',',',') }}</strong></th>
            </tr>
            
            <tr>
            <td style="text-align:center;font-size:12px" colspan="8"><b>Nợ hiện tại:</b></td>
            @if ($no_after_trahang_2 < 0)
            <th style="text-align:left;font-size:12px" colspan="2" ><b>0</b></th>
            @else
            <th style="text-align:left;font-size:12px" colspan="2" ><b>{{ number_format($sum - $dathu_tongno_kh_date->tongthu_kh ,0,',',',') }} VNĐ</b></th>
            @endif
            
            @endforeach
            </tr>


        </tbody>
    </table>
 