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

tr:hover {background-color: #f5f5f5;

}
</style>
    @if (empty($chitiet_kh_date))
        <h4>KHÁCH HÀNG NÀY CHƯA MUA HÀNG</4>
        <?php $a = '';?>
    @else
    @foreach($chitiet_kh_date as $ctkh)
    <?php
        $a = $ctkh->kh_ten;
        $id = $ctkh->kh_id;
    ?>
    @endforeach
    @endif

    @if (empty($chitiet_kh_date))
    @else

<h3>THÔNG TIN CHI TIẾT KHÁCH HÀNG {{$a}}</h3>
<h3>Thông tin các Đơn hàng</h3>

    <div class="container-fluid" id="container">

    <!-- form search -->

        <!-- <div class="row">

           <form method="POST" action="{{ route('khachhang.search',['id'=>$id]) }}">
           {{ csrf_field() }}
            
           <div class="col-md-3">
                <input type="date" name="from_date" id="from_date" class="form-control"/>
            </div>
            <div class="col-md-3">
                <input type="date" name="to_date" id="to_date" class="form-control"/>
            </div>
            <div class="col-md-1">
                <input type="hidden" name="kh_id" id="kh_id" class="form-control" value="<?php echo $id;?>">
            </div>
            <button type="submit">Submit</button>
            <a href="{{ route('khachhang.chitiet',['id'=>$id]) }}">Back</a>

           </form>
       </div> -->

       <a type="button" class="btn btn-dark" href="{{ route('khachhang.chitiet',['id'=>$id]) }}">Back</a>
       
       <h3>Từ {{ $from_date }} đến {{ $to_date }}</h3>
       

        </div>
    <br />
        <table class="table table-hover table-sm" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN HÀNG</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <!-- <th>CÔNG NỢ CŨ</th> -->

                  <!-- NỢ THEO ĐƠN = CÔNG NỢ MỚI -->
                  <th>NỢ ĐƠN</th>                  
                </tr>
            </thead>
            
            <tbody>
            <?php $sum=0; ?>
            @foreach($chitiet_kh_date as $ctkh)
                <tr>
                    <td>{{ $ctkh->ddh_id }}</td>
                    @if($ctkh->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif

                    <td>{{ $ctkh->ddh_ngaylap }}</td>

                    <!-- Nếu congnomoi=0 tức là đơn hàng đó đã trả -->
                    @if ($ctkh->ddh_congnomoi == 0)
                        <td>
                            <div style="color:green;"> {{ $ctkh->bccn_hanno }} (Đã trả)</div>
                        </td>
                    @else
                    @if ($current_day < $ctkh->bccn_hanno )
                        @if ($current_day_add >= $ctkh->bccn_hanno )
                            <td>
                                <div style="color:orange;">{{ $ctkh->bccn_hanno }} <br> (Sắp tới hạn)<div>
                            </td>
                        @else
                            <td>
                            {{ $ctkh->bccn_hanno }}
                            </td>
                        @endif
                    @elseif($current_day > $ctkh->bccn_hanno)
                        <td>
                            <div style="color:red;"><b>{{ $ctkh->bccn_hanno }}</b> <br> (Qúa hạn)<div>
                        </td>
                    @elseif($current_day == $ctkh->bccn_hanno)
                    <td>
                        <div style="color:blue;"><b>{{ $ctkh->bccn_hanno }}</b> <br> (Tới hạn)<div>
                    </td>
                    @endif
                    @endif
                    <!-- end -->
                        <td>{{ number_format($ctkh->ddh_congnomoi,0,',',',') }} VNĐ</td>

                    <?php $sum += $ctkh->ddh_congnomoi;?>
                </tr>
            @endforeach
            <tr>
            <td ><b>TỔNG CÔNG NỢ:</b></td>
            <td ></td>
            <td ></td>
            <td ></td>
            <td class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            <td ></td>
            </tr>
            </tbody>
        </table>

        
    </div>

    @endif


@endsection
