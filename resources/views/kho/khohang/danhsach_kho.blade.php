@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taokho" class="btn btn-info" href="{{URL::to('banhang/tao-kho')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo kho hàng</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê danh mục kho xuất hàng
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
            
            <th>Mã kho hàng</th>
            <th>Tên kho hàng</th>
            <th>Địa chỉ kho hàng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($khohang as $key => $dskho)
          <tr>
           
            <td>{{ $dskho->kho_id }}</td>
            <td>{{ $dskho->kho_ten}}</td>
            <td>{{ $dskho->kho_diachi}}</td>
             <td>
              <a href="{{URL::to('banhang/sua-kho/'.$dskho->kho_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                 <a onclick="return confirm('Bạn có chắc là muốn xóa kho hàng này không ?')" href="{{URL::to('/banhang/xoa-kho'.$dskho->kho_id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection