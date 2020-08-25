@extends('admin_banhang')
@section('admin_content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

<style>

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
    font-size: 1em;
    color: #101010;
}
table,th,tr {
  background-color: white ;
  color: rgb(0, 0, 0);
  text-align:center;
  font-family: Arial;

}
h3{ text-align:center;
    padding-bottom:20px;
}
h4{ text-align:center;
    padding-bottom:20px;
    color: red;
}
h5{ text-align:center;
    padding-bottom:20px;
}

.datarow{ text-align:center;}

tr:hover {background-color: #f5f5f5;}

.input-group-addon{
        padding: 6px 18px;
    }
span:hover{
cursor: pointer;
}
.glyphicon{
top: 4px;
right: 6px;
}

}
</style>
    @if (empty($chitiet_kh_date))
        <h4>KHÁCH HÀNG NÀY CHƯA MUA HÀNG</4>
        <br><br>
        <a type="button" class="btn btn-dark" href="{{ route('khachhang.index')}}">Trở về</a>
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

<h3>THÔNG TIN CHI TIẾT KHÁCH HÀNG</h3>
<h5>Khách Hàng: {{$a}}</h5>

    <div class="container-fluid" id="container">
       <!-- <h3>Từ {{ $from_date }} đến {{ $to_date }}</h3> -->
       <div class="row">
       <!-- new -->
       <div class="d-flex">
           <form method="POST" action="{{ route('khachhang.search',['id'=>$id]) }}">
           <!-- <input type="text" name="search" class="form-control m-input" placeholder="Enter Country Name" /> -->
           {{ csrf_field() }}
           <div class="col-sm-5">
           Từ ngày : 
                <div class="input-group date">
                <?php   $from_date = date('d-m-Y', strtotime($from_date));?>
                    <input type="text" class="date form-control" name="from_date" id="from_date" value="{{ old('from_date',$from_date) }}"/>
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>                    
            </div>
            <div class="col-sm-5">
            Đến ngày:
                <div class="input-group date">
                <?php   $to_date = date('d-m-Y', strtotime($to_date));?>
                    <input type="text" class="date form-control" name="to_date" id="to_date" value="{{ old('to_date',$to_date) }}" class="form-control"  />
                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                </div>
            </div>
            <div class="col-md-1">
                <input type="hidden" name="kh_id" id="kh_id" class="form-control" value="<?php echo $id;?>">
            </div>

            <div class="col-md-1">
                <br><button class="btn btn-outline-dark" type="submit">Tìm kiếm</button>
            </div>
        </form>
       </div>
        <div class="ml-auto" style="padding-right:20px">
        <a type="button" class="btn btn-dark" href="{{ route('khachhang.chitiet',['id'=>$id]) }}">Trở về</a>
       <a type="button" class="btn btn-dark" href="{{ route('khachhang.chitiet.excel.time', ['id'=>$id,'from_date'=>$from_date,'to_date'=>$to_date]) }}">Xuất Excel</a>
        </div>
        <!-- endnew -->

    <br />
    <div class="table-agile-info">
  <div class="panel panel-default">

    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN HÀNG</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <!-- <th>CÔNG NỢ CŨ</th> -->

                  <!-- NỢ THEO ĐƠN = CÔNG NỢ MỚI -->
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>
                  <th>CHI TIẾT</th>
                </tr>
            </thead>

            <tbody>
            <?php $sum=0; ?>
            <?php $tralaikhach=0; ?>
            @foreach($chitiet_kh_date as $ctkh)
                <tr>
                    <td>DH00{{ $ctkh->ddh_id }}</td>
                    @if($ctkh->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <?php 
                    $ctkh->ddh_ngaylap=date("d-m-Y", strtotime($ctkh->ddh_ngaylap));
                    ?>
                    <td>{{ $ctkh->ddh_ngaylap }}</td>
                    <?php 
                    $ctkh->bccn_hanno=date("d-m-Y", strtotime($ctkh->bccn_hanno));
                    ?>
                    <!-- Nếu congnomoi=0 tức là đơn hàng đó đã trả -->
                    @if ($ctkh->ddh_congnomoi == 0)
                        <td>
                            <div style="color:green;"> <b> {{ $ctkh->bccn_hanno }} (Đã trả)<b></div>
                        </td>
                    @else
                    @if (strtotime($current_day) < strtotime($ctkh->bccn_hanno) )
                        @if (strtotime($current_day_add) > strtotime($ctkh->bccn_hanno) )
                            <td>
                                <div style="color:blue;"><b>{{ $ctkh->bccn_hanno }} <br> (Sắp tới hạn)</b><div>
                            </td>
                        @else
                            <td>
                            {{ $ctkh->bccn_hanno }}
                            </td>
                        @endif
                    @elseif(strtotime($current_day) > strtotime($ctkh->bccn_hanno))
                        <td>
                            <div style="color:red;"><b>{{ $ctkh->bccn_hanno }} <br> (Qúa hạn)</b><div>
                        </td>
                    @elseif(strtotime($current_day) == strtotime($ctkh->bccn_hanno))
                    <td>
                        <div style="color:orange;"><b>{{ $ctkh->bccn_hanno }}<br> (Tới hạn)</b> <div>
                    </td>
                    @endif
                    @endif
                    <!-- end -->
                        <td>{{ number_format($ctkh->tongtien,0,',',',') }} VNĐ</td>
                        <?php $no = $ctkh->tongtien-$ctkh->ddh_datra;?>
                        <td>{{ number_format($no,0,',',',') }}</td>
                        <!-- <td>{{ number_format($ctkh->giatri_trahang,0,',',',') }} VNĐ</td> -->
                        @if ($ctkh->giatri_trahang == NULL)
                    <td>0</td>
                @else
                    <td>{{ number_format($ctkh->giatri_trahang,0,',',',') }}</td>
                @endif
                <?php $no_after_trahang_1 = $no - $ctkh->giatri_trahang;
                        $no_after_trahang_2 = $no - $ctkh->giatri_trahang;
                    // if ($no_after_trahang_1 < 0){
                    //     $no_after_trahang_1=0;
                    // }
                ?>
                <td>{{ number_format($no_after_trahang_1,0,',',',') }} </td>

                     <!-- sum là tổng nợ đc tính sau khi khách trả hàng -->
                     <?php $sum += $no_after_trahang_1; ?>

                    <td>
                    <a href="{{URL::to('/banhang/chitietdondathang/'.$ctkh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-eye text-active" title="Xem chi tiết"></i></a> &nbsp;

                    </td>
                </tr>
                <?php $tralaikhach += $ctkh->pth_ctk; ?>

            @endforeach
            <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>
            <td  class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr>
            <tr>
            @foreach($dathu_tongno_kh_date as $dathu_tongno_kh_date)
            <td colspan="7"><b>ĐÃ THU:</b></td>
            <td  class="text-center"><b>{{ number_format($dathu_tongno_kh_date->tongthu_kh,0,',',',') }} VNĐ</b></td>
           
            <tr>
            <td colspan="7"><b>TIỀN TRẢ LẠI KHÁCH:</b></td>
            <td><b>{{ number_format($tralaikhach,0,',',',') }} VNĐ</b></td>               
            </tr>
             <tr>
            <td colspan="7"><b>NỢ HIỆN TẠI:</b></td>
            @if ($no_after_trahang_2 < 0)
            <th ><b>0 VNĐ</b></th>
            @else
            <th ><b>{{ number_format($sum - $dathu_tongno_kh_date->tongthu_kh,0,',',',') }} VNĐ</b></th>
            @endif
            @endforeach
            </tr>

            </tbody>
        </table>

    </div>
    </div>
</div>
    @endif

    <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
   
</script>

@endsection
