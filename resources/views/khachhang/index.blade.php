@extends('admin_banhang')
@section('admin_content')

<h3>Chào mừng bạn đến với Quản lý Khách hàng</h3>
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<style>

table,th,tr {
  background-color: white ;
  color: rgb(0, 0, 0);
  text-align:center;
}

.datarow{ text-align:center;}

tr:hover {background-color: #f5f5f5;}
</style>
<a  type="button" class="btn btn-success" href="{{URL::to('banhang/khachhang/create')}}"> <i class="glyphicon glyphicon-plus"></i> Tạo Khách hàng mới</a>
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

    <div class="panel-heading">
      Liệt kê danh mục Khách Hàng
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-sm" id="dataTables-example">
            <thead>
                <tr>
                  <th>MÃ KHÁCH HÀNG</th> 
                  <th>HỌ TÊN</th>
                  <th>ĐỊA CHỈ </th>
                  <th>SÔ ĐIỆN THOẠI</th>
                  <th>TỔNG NỢ CHƯA TRẢ</th>
                  <th>XEM CHI TIẾT</th>
                  <th>HÀNH ĐỘNG</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach($kh as $kh)
                <tr>
                    <td>{{ $kh->kh_id }}</td>
                    <td>{{ $kh->kh_ten }}</td>
                    <td>{{ $kh->kh_diachi }}</td>
                    <td>{{ $kh->kh_sdt }}</td>
                    @if($kh->tongcongno == null)
                    <td>0</td>
                    @else
                    <td>{{ number_format($kh->tongcongno,0,',',',') }}</td>
                    @endif
                    <td>
                        <a href="{{URL::to('banhang/khachhang/chitiet/'.$kh->kh_id)}}" class="active styling-edit" ui-toggle-class="">
                            <i class="fa fa-eye text-success text-active"></i></a>
                    </td>
                    <td>
                        <a href="{{URL::to('banhang/khachhang/edit/'.$kh->kh_id)}}" class="active styling-edit" ui-toggle-class="">
                        <i class="fa fa-edit fa-lg" aria-hidden="true"></i></a>
						<a href=" {{URL::to('/banhang/pdf-chitietcongno-kh/'.$kh->kh_id)}}" class="active styling-edit" ui-toggle-class="">
                        <i class="fa fa-print fa-lg" ></i></a>
					</td>
                </tr>
            @endforeach
                
            </tbody>
        </table>
    </div>
    </div>
</div>
@endsection