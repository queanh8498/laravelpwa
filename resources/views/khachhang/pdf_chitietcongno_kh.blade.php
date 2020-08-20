<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Phiếu chi tiết công nợ</title>
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
        .table{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <h1><center>PHIẾU CHI TIẾT CÔNG NỢ</center></h1>

    @foreach($dh_first as $key => $dh_first)
    <?php
        $date=date("d/m/Y", strtotime($dh_first->ngaylap));
        $now = now();
        $now = date("d/m/Y", strtotime($now));
        $id = date("d/m/Y", strtotime($now));
    ?>
    @endforeach
    <span><center>Sổ Tiền Mặt Tân Thành -- Ngày: {{ $date ?? '00-00-00' }}</center></span>
<br>

    <span><center><i>Khách hàng: </i><strong>{{$kh->kh_ten}}</strong></center></span>
    <span><center><i>Địa chỉ: </i><strong>{{$kh->kh_diachi}}</strong></center></span>
    <span><center><i>Số điện thoại: </i><strong>{{$kh->kh_sdt}}</strong></center></span>

    <br>

    <table width=100%>
        <tr>
            <td><i>Từ ngày: </i><strong> {{ $date ?? '00-00-00'}}</strong></td>
            <td style="text-align: right;"><i>Đến ngày: </i><strong>{{ $now ?? '00-00-00' }}</strong></td>

        </tr>
    </table>
    <br>
    <table border="1" width=100% class="table">
        <thead>
            <tr>
                <th rowspan="2">STT</th>
                <th rowspan="2">Ngày mua</th>
                <th rowspan="2">Số chứng từ</th>
                <th rowspan="2">Tổng tiền (VND)</th>
                <th colspan="2">Số tiền (VND)</th>
                <th rowspan="2">Trả hàng </th>
                <th rowspan="2">Nợ </th>

            </tr>
            <tr>


            <th>Đã trả</th>
            <th>Nợ</th>

            </tr>
        </thead>

        <tbody>
            <?php
                $i=1;
                $sum=0;
            ?>
            @foreach($chitiet_kh as $key => $chitiet_kh)
            <tr align=center>
                <td>{{ $i++ }}</td>
                <?php
                $date=date("d-m-Y", strtotime($chitiet_kh->ddh_ngaylap ));
                ?>
                <td>{{ $date }}</td>
                <td>DH00{{ $chitiet_kh->ddh_id }}</td>
                <td>{{ number_format($chitiet_kh->tongtien,0,',',',') }}</td>
                <td>{{ number_format($chitiet_kh->ddh_datra,0,',',',') }}</td>
                <?php $no = $chitiet_kh->tongtien-$chitiet_kh->ddh_datra;?>
                <td>{{ number_format($no,0,',',',') }}</td>
               
                
                <!-- có trả hàng thì hiện ra giá trị trả  -->
                @if ($chitiet_kh->giatri_trahang == NULL)
                    <td>0</td>
                @else
                    <td>{{ number_format($chitiet_kh->giatri_trahang,0,',',',') }}</td>
                @endif
                <?php $no_after_trahang = $no - $chitiet_kh->giatri_trahang;
                    if ($no_after_trahang < 0){
                        $no_after_trahang=0;
                    }
                ?>
                <td>{{ number_format($no_after_trahang,0,',',',') }} </td>

                <!-- sum là tổng nợ đc tính sau khi khách trả hàng -->
                <?php $sum += $no_after_trahang; ?>

            </tr>
            @endforeach
            <tr>
            <th colspan="7">Tổng nợ</th>
            <th>{{ number_format($sum,0,',',',') }}</th>
            </tr>

            <tr>
            @foreach($dathu_tongno_kh as $dathu_tongno_kh)
            <th colspan="7">Đã thu:</th>
            <th>{{ number_format($dathu_tongno_kh->tongthu_kh,0,',',',') }}</td>
            </tr>
                
                
                <tr>
                    <th colspan="7"><b>Tiền trả lại khách:</b></th>
                    <!-- <?php //$tralaikhach = abs($sum - $dathu_tongno_kh->tongthu_kh) ; ?> -->
                    <th>{{ number_format($chitiet_kh->pth_ctk,0,',',',') }}</th>
                </tr>
               

             <tr>
            <th colspan="7"><b>Nợ hiện tại:</b></th>

            <th >{{ number_format($dathu_tongno_kh->tongno,0,',',',') }}</th>

            <!-- @if($dathu_tongno_kh->tongthu_kh != 0)
            <th >{{ number_format($dathu_tongno_kh->tongno,0,',',',') }}</th>

            @else
            <th>{{ number_format($sum,0,',',',') }} </th>

            @endif -->

            @endforeach
            </tr>

        </tbody>
    </table>
    <br>
    <table align="right" width=50% cellpadding="5px">

    </table>
    <br>
    <hr style="color: black; margin-top: 150px;" />
    <h4 style="text-align: right; margin-right: 120px;">Người lập phiếu</h4>
    <br>
    <h4 style="text-align: right; margin-right: 100px;"></h4>
</body>
</html>
