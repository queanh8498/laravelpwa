@extends('admin_banhang')
@section('admin_content')


<style>

table,th,tr {
  background-color: white ;
  color: rgb(0, 0, 0);
  text-align:center;
}
h3{ text-align:center; 
    padding-bottom:20px;
}
h4{ text-align:center; 
    padding-bottom:20px;
    color: red;
}

.datarow{ text-align:center;}

tr:hover {background-color: #f5f5f5;}
</style>
    @if (empty($chitiet_kh))
        <h4>KHÁCH HÀNG NÀY CHƯA MUA HÀNG</4>
        <?php $a = '';?>
    @else
    @foreach($chitiet_kh as $ctkh)
    <?php
        $a = $ctkh->kh_ten;
    ?>
    @endforeach
    @endif

    @if (empty($chitiet_kh))
    @else

<h3>THÔNG TIN CHI TIẾT KHÁCH HÀNG {{$a}}</h3>
<h3>Thông tin các Đơn hàng</h3>

    <div class="container-fluid" id="container">
        <table class="table table-hover table-sm" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN HÀNG</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <th>CÔNG NỢ CŨ</th>
                  <th>CÔNG NỢ MỚI</th>
                  
                </tr>
            </thead>
            
            <tbody>
            <?php $sum=0; ?>
            @foreach($chitiet_kh as $ctkh)
                <tr>
                    <td>{{ $ctkh->ddh_id }}</td>
                    @if($ctkh->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <td>{{ $ctkh->ddh_ngaylap }}</td>
                    <td>{{ $ctkh->bccn_hanno }}</td>
                    <td>{{ number_format($ctkh->ddh_congnocu,0,',',',') }} VNĐ</td>
                    <td>{{ number_format($ctkh->ddh_congnomoi,0,',',',') }} VNĐ</td>
                    <?php $sum += $ctkh->ddh_congnomoi;?>
                </tr>
            @endforeach
            <tr>
            <td ><b>TỔNG CÔNG NỢ:</b></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>

            </tr>
            </tbody>
        </table>

        
    </div>

    @endif

@endsection