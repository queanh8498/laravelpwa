@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taopth" class="btn btn-info" href="{{URL::to('banhang/tao-pth')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo phiếu khách trả hàng</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Danh sách phiếu khách trả hàng
    </div>
  
                         @if(session('thongbao'))
                            <span class="text-alert">
                                {{session('thongbao')}}
                            </span>
                        @endif
    <div class="table-responsive">
<table class= "table table-bordered table-striped"  id="dataTables-example">
        <thead>
          <tr>
            
            <th>Mã phiếu khách trả hàng</th>
            <th>Nhân viên tạo phiếu</th>
            <th>Khách hàng</th>
            <th>Số điện thoại Khách hàng</th>
            <th>Ngày lập</th>
         
            <th >Hành động</th>
          </tr>
        </thead>
        <tbody>
        
          @foreach($pth as $dspth)
          <tr>
           <?php 
            $ngaylap=date("d-m-Y H:i:s", strtotime($dspth->pth_ngaylap));
         
          ?>
            <td>PTH00{{ $dspth->pth_id }}</td>
             <td>{{ $dspth->User->name }}</td>
              <td>{{ $dspth->dondathang->khachhang->kh_ten }}</td>
                 <td>{{ $dspth->dondathang->khachhang->kh_sdt }}</td>
               <td>{{ $ngaylap }}</td>
             
             <td>
              <a href="{{URL::to('/banhang/chitiet-pth/'.$dspth->pth_id)}}"   class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active" title="Xem chi tiết phiếu trả hàng"></i></a>
                  <a href=" {{URL::to('/banhang/pdf-pth/'.$dspth->pth_id)}}" class="active styling-edit" ui-toggle-class=""  ><i class="fa fa-print" title="Xuất pdf phiếu trả hàng"></i></a>
                    <a href="{{ URL::to('/banhang/excel-pth/'.$dspth->pth_id) }}" class="active styling-edit" ui-toggle-class="">
                        <i class="fa fa-file-excel-o" title="Xuất excel phiếu trả hàng"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection