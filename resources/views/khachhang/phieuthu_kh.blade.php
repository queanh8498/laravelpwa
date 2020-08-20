@extends('admin_banhang')
@section('admin_content')
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

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

</style>
    
<h3><b>THÔNG TIN PHIẾU THU KHÁCH HÀNG</b></h3>
<h3><b>Khách Hàng: {{$kh->kh_ten}}</b></h3>
<a type="button" class="btn btn-dark" href="{{ route('khachhang.chitiet',['id'=>$kh->kh_id]) }}">Trở về</a>
<hr>
<div class="table-agile-info">
  <div class="panel panel-default">

    <div class="panel-heading" style="font-size:25px">
      <b>Danh Sách Phiếu Thu</b>
    </div>

<?php $tongthu=0;?>

    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
                <thead>
                    <tr>
                        <th >Mã phiếu</th>
                        <th >Người lập phiếu</th>
                        <th >Ngày lập</th>
                        <th >Tiền thu</th>
                    </tr>
                </thead>
            
            <tbody>
            @foreach($phieuthu_kh as $phieuthu_kh)
            <tr>
                <td>PT000{{ $phieuthu_kh->pt_id }}</td>
                <td>{{ $phieuthu_kh->name }}</td>

                <?php 
                    $phieuthu_kh->pt_ngaylap=date("d-m-Y", strtotime($phieuthu_kh->pt_ngaylap));
                    ?>
                <td>{{ $phieuthu_kh->pt_ngaylap }}</td>
                <td>{{ number_format($phieuthu_kh->pt_tienthu,0,',',',')  }}</td>
                <?php $tongthu += $phieuthu_kh->pt_tienthu;?>
            </tr>
            @endforeach
            <tr>
                <th colspan="3"><b>TỔNG THU</b></th>
                <td class="text-center"><b>{{ number_format($tongthu,0,',',',') }}</b></td>
            </tr>
            </tbody>
        </table>
    </div>

    </div>
</div>
@endsection