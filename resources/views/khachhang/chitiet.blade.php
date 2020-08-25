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
  color: black;
  text-align:center;
  font-family: Arial;
  border: 1px solid #ddd;
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

#table1, #table2, #table3, #table4, #table5{
    display: none;
}
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

</style>
    @if (empty($chitiet_kh))
        <h4>KHÁCH HÀNG NÀY CHƯA MUA HÀNG</4>
        <?php $a = '';?>
    @else
    @foreach($chitiet_kh as $ctkh)
    <?php
        $a = $ctkh->kh_ten;
		$id = $ctkh->kh_id;

    ?>
    @endforeach
    @endif

    @if (empty($chitiet_kh))
    @else

<h3 style="margin-top:-15px">THÔNG TIN CHI TIẾT KHÁCH HÀNG</h3>
<h5 style="margin-top:-15px"> Khách Hàng: {{$a}}</h5>

<a style="margin-top:15px" type="button" class="btn btn-dark" href="{{ route('khachhang.index') }}">Trở về</a>
<br>
<div class="d-flex" >
            <div style="width: 600px;"> 
            <form method="POST" action="{{ route('khachhang.search',['id'=>$id]) }}">
                    {{ csrf_field() }}
                       
                        <div class="col-sm-4">
                        Từ ngày : 
                            <div class="input-group date">
                                <input type="text" class="date form-control" name="from_date" id="from_date"/>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-sm-4">
                        Đến ngày:
                            <div class="input-group date">
                                <input type="text" class="date form-control" name="to_date" id="to_date" class="form-control"  />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>

                        <div class="col-md-1">
                            <br><button class="btn btn-dark" type="submit">Tìm kiếm</button>
                        </div>
                        <div class="col-md-1">
                            <input type="hidden" name="kh_id" id="kh_id" class="form-control" value="<?php echo $id;?>">
                        </div>
                </form>
            </div>
            <div class="ml-auto" style="padding-top:20px">
                <a class="btn btn-warning" onclick='show(1);' ><b>Tới hạn</b></a>
                <a class="btn btn-danger" onclick='show(3);' style="color:white;"><b>Quá hạn</b></a>
                <a class="btn btn-info" onclick='show(4);'  style="color:white;"><b>Sắp tới hạn</b></a>
                <a class="btn btn-success" onclick='show(5);'  style="color:white;/"><b>Đã trả</b></a>
                <a class="btn btn-light" onclick='show(10);'><b>Tất cả Đơn</b></a>
            </div>
        </div>      
	 <div class="row">
        @if(count($errors)>0)
        <span class="text-alert">
            @foreach($errors->all() as $err)
                {{$err}}<br>
            @endforeach
        </span>
        @endif
        </div>

    <div class="table-agile-info">
  <div class="panel panel-default">
    <!-- =======================================tới hạn -->
    <div id="table1">
    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>

                  <th>CHI TIẾT</th>

                </tr>
            </thead>

            <tbody>
            <?php $sum=0; ?>
            @foreach($dh_toihan as $dh_toihan)
                @if ($dh_toihan->ddh_id == NULL)
                @else
                <tr>
                    <td>DH00{{ $dh_toihan->ddh_id }}</td>
                    @if($dh_toihan->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <?php 
                    $dh_toihan->ddh_ngaylap=date("d-m-Y", strtotime($dh_toihan->ddh_ngaylap));
                    $dh_toihan->bccn_hanno=date("d-m-Y", strtotime($dh_toihan->bccn_hanno));
                    ?>
                    <td>{{ $dh_toihan->ddh_ngaylap }}</td>

                    <td  style="color:orange;"><b>{{ $dh_toihan->bccn_hanno }} (Tới hạn)</b></td>
                    
                    <td>{{ number_format($dh_toihan->tongtien,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_toihan->no,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_toihan->giatri_trahang,0,',',',') }} VNĐ</td>
                    @if($dh_toihan->no < $dh_toihan->giatri_trahang)
                    <td>{{ number_format($dh_toihan->no - $dh_toihan->giatri_trahang ,0,',',',') }} VNĐ</td>
                    @else
                    <td>{{ number_format($dh_toihan->ddh_congnomoi,0,',',',') }} VNĐ</td>
                    @endif
                    <?php $sum += $dh_toihan->ddh_congnomoi;?>
                    <?php $sum += $dh_toihan->no - $dh_toihan->giatri_trahang;?>
                    <td>
                    <a href="{{URL::to('/banhang/chitietdondathang/'.$dh_toihan->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-eye text-active" title="Xem chi tiết"></i></a> &nbsp;

                    </td>
                </tr>
                @endif
            @endforeach
            <!-- <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>

            <td colspan="2" class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr> -->
            </tbody>
        </table>
    </div>
    </div>

    <a class="btn btn-light btn-sm btn-block" onclick='show(2);'></a>

    <!-- ====================================end table1 - tới hạn -->
    <div id="table2"></div>

    <!-- =======================================quá hạn -->
    <div id="table3">
    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>


                  <th>CHI TIẾT</th>

                </tr>
            </thead>

            <tbody>
            <?php $sum=0; ?>
            @foreach($dh_quahan as $dh_quahan)
            @if ($dh_quahan->ddh_id == NULL)
                @else
                <tr>
                    <td>DH00{{ $dh_quahan->ddh_id }}</td>
                    @if($dh_quahan->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <?php 
                    $dh_quahan->ddh_ngaylap=date("d-m-Y", strtotime($dh_quahan->ddh_ngaylap));
                    $dh_quahan->bccn_hanno=date("d-m-Y", strtotime($dh_quahan->bccn_hanno));
                    ?>
                    <td>{{ $dh_quahan->ddh_ngaylap }}</td>

                    <td style="color:red"><b>{{ $dh_quahan->bccn_hanno }} (Qúa hạn)</b></td>

                    <td>{{ number_format($dh_quahan->tongtien,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_quahan->no,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_quahan->giatri_trahang,0,',',',') }} VNĐ</td>
                    @if($dh_quahan->no < $dh_quahan->giatri_trahang)
                    <td>{{ number_format($dh_quahan->no - $dh_quahan->giatri_trahang ,0,',',',') }} VNĐ</td>
                    @else
                    <td>{{ number_format($dh_quahan->ddh_congnomoi,0,',',',') }} VNĐ</td>
                    @endif
                    <?php $sum += $dh_quahan->ddh_congnomoi;?>

                    <td>
                            <a href="{{URL::to('/banhang/chitietdondathang/'.$dh_quahan->ddh_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-eye text-active" title="Chi tiết đơn hàng"></i></a>
                    </td>
                </tr>
                @endif
            @endforeach
            <!-- <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>

            <td colspan="2" class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr> -->
            </tbody>
        </table>
    </div>
    </div>

    <!-- ====================================end table1 - tới hạn -->
    <div id="table2"></div>

    <div id="table4">
    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>


                  <th>CHI TIẾT</th>

                </tr>
            </thead>

            <tbody>
            <?php $sum=0; ?>
            @foreach($dh_saptoihan as $dh_saptoihan)
            @if ($dh_saptoihan->ddh_id == NULL)
                @else
                <tr>
                    <td>DH00{{ $dh_saptoihan->ddh_id }}</td>
                    @if($dh_saptoihan->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <?php 
                    $dh_saptoihan->ddh_ngaylap=date("d-m-Y", strtotime($dh_saptoihan->ddh_ngaylap));
                    $dh_saptoihan->bccn_hanno=date("d-m-Y", strtotime($dh_saptoihan->bccn_hanno));
                    ?>
                    <td>{{ $dh_saptoihan->ddh_ngaylap }}</td>

                    <td style="color:blue"><b>{{ $dh_saptoihan->bccn_hanno }} (Sắp tới hạn)</b></td>
                    
                    <td>{{ number_format($ctkh->tongtien,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_saptoihan->no,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_saptoihan->giatri_trahang,0,',',',') }} VNĐ</td>
                    @if($dh_saptoihan->no < $dh_saptoihan->giatri_trahang)
                    <td>{{ number_format($dh_saptoihan->no - $dh_saptoihan->giatri_trahang ,0,',',',') }} VNĐ</td>
                    @else
                    <td>{{ number_format($dh_saptoihan->ddh_congnomoi,0,',',',') }} VNĐ</td>
                    @endif
                    <?php $sum += $dh_saptoihan->ddh_congnomoi;?>

                    <td>
                            <a href="{{URL::to('/banhang/chitietdondathang/'.$dh_saptoihan->ddh_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-eye text-active" title="Chi tiết đơn hàng"></i></a>
                    </td>
                </tr>
                @endif
            @endforeach
            <!-- <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>

            <td colspan="2" class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr> -->
            </tbody>
        </table>
    </div>
    </div>

    <!-- ====================================end table4 - sắp tới hạn -->
    <div id="table2"></div>

    <div id="table5">
    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>


                  <th>CHI TIẾT</th>
                </tr>
            </thead>

            <tbody>
            <?php $sum=0; ?>
            @foreach($dh_datra as $dh_datra)
            @if ($dh_datra->ddh_id == NULL)
                @else
                <tr>
                    <td>DH00{{ $dh_datra->ddh_id }}</td>
                    @if($dh_datra->id == 1)
                    <td>Nhân viên bán hàng</td>
                    @else
                    <td>Kế toán công nợ</td>
                    @endif
                    <?php 
                    $dh_datra->ddh_ngaylap=date("d-m-Y", strtotime($dh_datra->ddh_ngaylap));
                    $dh_datra->bccn_hanno=date("d-m-Y", strtotime($dh_datra->bccn_hanno));
                    ?>
                    <td>{{ $dh_datra->ddh_ngaylap }}</td>

                    <td style="color:green"><b>{{ $dh_datra->bccn_hanno }} (Đã trả)</b></td>
                    <td>{{ number_format($dh_datra->tongtien,0,',',',') }} VNĐ</td>
                   
                    <!-- $ddh_datra->no là tổng tiền đơn hàng - phần đã trả -->
                    <td>{{ number_format($dh_datra->no,0,',',',') }} VNĐ</td>

                    <td>{{ number_format($dh_datra->giatri_trahang,0,',',',') }} VNĐ</td>
                    @if($dh_datra->no < $dh_datra->giatri_trahang)
                    <td>{{ number_format($dh_datra->no - $dh_datra->giatri_trahang ,0,',',',') }} VNĐ</td>
                    @else
                    <td>{{ number_format($dh_datra->ddh_congnomoi,0,',',',') }} VNĐ</td>
                    @endif

                    <?php $sum += $dh_datra->ddh_congnomoi;?>


                    <td>
                            <a href="{{URL::to('/banhang/chitietdondathang/'.$dh_datra->ddh_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-eye text-active" title="Chi tiết đơn hàng"></i></a>
                    </td>
                </tr>
                @endif
            @endforeach
            <!-- <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>

            <td colspan="2" class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr> -->
            </tbody>
        </table>
    </div>
    </div>

    <!-- ====================================end table4 - sắp tới hạn -->
    

    <div id="table10">
    <div class="panel-heading" style="font-size:25px">
      <b>Thông tin các Đơn hàng</b>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>MÃ ĐƠN</th>
                  <th>NHÂN VIÊN </th>
                  <th>NGÀY LẬP ĐƠN</th>
                  <th>NGÀY TỚI HẠN</th>
				   <!-- NỢ THEO ĐƠN = CÔNG NỢ MỚI -->
                  <th>TỔNG TIỀN</th>
                  <th>NỢ ĐƠN</th>
                  <th>TRẢ HÀNG</th>
                  <th>TỔNG NỢ THEO ĐƠN</th>
                  <th>CHI TIẾT</th>
				  <!-- <th>TỔNG NỢ THEO ĐƠN</th> -->
                </tr>
            </thead>

            <tbody>
            <?php $sum=0; $tralaikhach=0; ?>
            @foreach($chitiet_kh as $ctkh)
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
                            <div style="color:green;"><b> {{ $ctkh->bccn_hanno }} (Đã trả)<b></div>
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
                            <div style="color:red;"><b>{{ $ctkh->bccn_hanno }} <br> (Qúa hạn) </b><div>
                        </td>
                    @elseif(strtotime($current_day) == strtotime($ctkh->bccn_hanno))
                    <td>
                        <div style="color:orange;"><b>{{ $ctkh->bccn_hanno }} <br> (Tới hạn)</b><div>
                    </td>
                    @endif
                    @endif
                    <!-- end -->
                    <td>{{ number_format($ctkh->tongtien,0,',',',') }} VNĐ</td>
                    <?php $no = $ctkh->tongtien-$ctkh->ddh_datra;?>
                    <td>{{ number_format($no,0,',',',') }}</td>
                    
                    @if ($ctkh->giatri_trahang == NULL)
                    <td>0</td>
                @else
                    <td>{{ number_format($ctkh->giatri_trahang,0,',',',') }}</td>
                @endif
                <?php $no_after_trahang = $no - $ctkh->giatri_trahang;
                    // if ($no_after_trahang < 0){
                    //     $no_after_trahang=0;
                    // }
                ?>
                <td>{{ number_format($no_after_trahang,0,',',',') }} </td>
                    <!-- sum là tổng nợ đc tính sau khi khách trả hàng -->
                    <?php $sum += $no_after_trahang; ?>
					<td>
                            <a href="{{URL::to('/banhang/chitietdondathang/'.$ctkh->ddh_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-eye text-active" title="Chi tiết đơn hàng"></i></a>
                    </td>
                </tr>
                <?php $tralaikhach += $ctkh->pth_ctk; ?>

            @endforeach
            <tr>
            <td colspan="7"><b>TỔNG CÔNG NỢ ĐƠN HÀNG:</b></td>
            <td  class="text-center"><b>{{ number_format($sum,0,',',',') }} VNĐ</b></td>
            </tr>
            <tr>
            @foreach($dathu_tongno_kh as $dathu_tongno_kh)
            <td colspan="7"><b>ĐÃ THU:</b></td>
            <td  class="text-center"><b>{{ number_format($dathu_tongno_kh->tongthu_kh,0,',',',') }} VNĐ</b></td>
           
            @if($dathu_tongno_kh->tongthu_kh==0)
            @else
            <td colspan="2">
                <a href="{{URL::to('banhang/khachhang/phieuthu/'.$id)}}" ui-toggle-class="">
                <i class="fa fa-eye text-warning" title="Chi tiết thu nợ"></i></a>
            </td>
                   
            @endif
            <tr>
            <td colspan="7"><b>TIỀN TRẢ LẠI KHÁCH:</b></td>
            <td><b>{{ number_format($tralaikhach,0,',',',') }} VNĐ</b></td>
               
            </tr>
             <tr>
            <td colspan="7"><b>NỢ HIỆN TẠI:</b></td>
            <th ><b>{{ number_format($dathu_tongno_kh->tongno,0,',',',') }} VNĐ</b></th>

            @endforeach
            </tr>
            </tbody>
        </table>

    </div>
    </div>
    </div>
</div>
    @endif

     <script>
function show(nr) {
    document.getElementById("table1").style.display="none";
    document.getElementById("table2").style.display="none";
    document.getElementById("table3").style.display="none";
    document.getElementById("table4").style.display="none";
    document.getElementById("table5").style.display="none";
    document.getElementById("table10").style.display="none";
   

    document.getElementById("table"+nr).style.display="block";
}

 </script>

 <script type="text/javascript">
    $('.date').datepicker({  
       format: 'dd-mm-yyyy'
     });  
   
</script>
@endsection