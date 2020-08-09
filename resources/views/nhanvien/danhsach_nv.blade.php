@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taonv" class="btn btn-info" href="{{URL::to('banhang/tao-nv')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo nhân viên</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách nhân viên
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
            
           
            <th>Tên nhân viên</th>
             <th>Mã nhân viên</th>
            <th>Địa chỉ</th>
              <th>Email</th>
                <th>Số điện thoại</th>
              <th>Quyền</th>
              
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($nv as $key => $dsnv)
          <tr>
              <td>{{ $dsnv->name}}</td>
            <td>NV00{{ $dsnv->id }}</td>
             <td>{{ $dsnv->diachi}}</td>
            <td>{{ $dsnv->email}}</td>
            <td>{{ $dsnv->sdt}}</td>
            @if($dsnv->quyen==9)
             <td>Quản lý công nợ, Quản lý kho, Quản lý bán hàng, Quản lý nhân viên</td>
             @elseif($dsnv->quyen==8)
               <td>Quản lý công nợ, Quản lý kho</td>
             @elseif($dsnv->quyen==6)
               <td>Quản lý bán hàng, Quản lý kho</td>
                 @elseif($dsnv->quyen==4)
               <td>Quản lý bán hàng, Quản lý công nợ</td>
               @elseif($dsnv->quyen==5)
               <td> Quản lý kho</td>
                 @elseif($dsnv->quyen==3)
               <td> Quản lý công nợ</td>
                 @elseif($dsnv->quyen==1)
               <td> Quản lý bán hàng</td>
                  @elseif($dsnv->quyen==0)
               <td>Nhân viên chưa được cấp quyền</td>
               @endif

             <td>
              <a href="{{URL::to('banhang/sua-nv/'.$dsnv->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-pencil-square-o text-success text-active"></i></a>
                 <a onclick="return confirm('Bạn có chắc là muốn xóa nhân viên này không ?')" href="{{URL::to('/banhang/xoa-nv/'.$dsnv->id)}}" class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i> </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection