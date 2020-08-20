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
.table,th,tr {
  background-color: ;
  color: black;
  text-align:center;
  font-family: Arial;
  border: 1px solid #ddd;
}

.datarow{ text-align:center;}

tr:hover {background-color: #f5f5f5;}
</style>
<a  type="button" class="btn btn-success" href="{{URL::to('banhang/phieuthu/create')}}"> <i class="glyphicon glyphicon-plus"></i>Lập phiếu thu</a>
<br><br>
<div class="flash-message">
    @foreach(['warning','success','info','danger'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif
    @endforeach
</div>
<div class="table-agile-info">
  <div class="panel panel-default">

    <div class="panel-heading" style="font-size:25px">
      <b>Danh Sách Phiếu Thu</b>
    </div>
    
    <div class="table-responsive">
        <table class="table table-bordered b-t b-dark" id="tableMain">
            <thead>
                <tr>
                  <th>Mã phiếu</th> 
                  <th>Người lập</th> 
                  <th>Ngày lập phiếu</th> 
                  <th>Họ tên</th>
                  <th>Số tiền thu (VND)</th>
                </tr>   
            </thead>
            
            <tbody>
            <?php $tongthu=0;?>

            @foreach($pt as $pt)
                <tr>
                    <td>PT000{{ $pt->pt_id }}</td>

                    <td>{{ $pt->name }}</td>
                    
                    <?php 
                    $pt->pt_ngaylap=date("d-m-Y", strtotime($pt->pt_ngaylap));
                    ?>
                    <td>{{ $pt->pt_ngaylap }}</td>
                    <td>{{ $pt->kh_ten }}</td>
                    <td>{{ number_format($pt->pt_tienthu,0,',',',') }}</td>
                    <?php $tongthu += $pt->pt_tienthu; ?>
                </tr>
            @endforeach
            <tr>
                <td colspan="4"><b>TỔNG TIỀN THU</b></td>
                <td><b>{{ number_format($tongthu,0,',',',') }} VNĐ</b></td>
            </tr>
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection