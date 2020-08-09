@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taohh" class="btn btn-info" href="{{URL::to('banhang/tao-hh')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo hàng hóa</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách hàng hóa
    </div>
  
                         @if(session('thongbao'))
                            <span class="text-alert">
                                {{session('thongbao')}}
                            </span>
                        @endif
    <div class="table-responsive">
<table class="table table-striped b-t b-light" id="dataTables-example">
        <thead>
          <tr>
            <th>Tên hàng hóa</th>  
            <th>Mã hàng hóa</th>
             <th>Đơn vị tính</th>
            <th>Nhóm hàng hóa</th>
            <th width="12%">Kho hàng</th>
          
            <th width="12%">Đơn giá</th>
            <th>Số lượng</th>
            <th>Ngày tạo mới</th>
            <th>Ngày cập nhật</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($hh as $key => $dshh)
          <tr>
            <td>{{$dshh->hh_ten }}</td>
            <td>HH00{{$dshh->hh_id}}</td>
            <td>{{$dshh->hh_donvitinh}}</td>
            <td>{{$dshh->nhomhanghoa->nhom_ten}}</td>
            <td>{{$dshh->khohang->kho_ten}}</td>
            <td>{{number_format($dshh->hh_dongia).' '.'VNĐ'}}</td>
            <td>{{$dshh->hh_soluong}}</td>
            <td>{{$dshh->hh_ngaytaomoi}}</td>
            <td>{{$dshh->hh_ngaycapnhat }}</td>
             <td>
              <a href="{{URL::to('/banhang/sua-hh/'.$dshh->hh_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                  <a onclick="return confirm('Bạn có chắc là muốn xóa hàng hóa này không ?')" href="{{URL::to('/banhang/xoa-hh/'.$dshh->hh_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection