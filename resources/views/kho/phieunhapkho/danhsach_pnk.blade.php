@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taopnk" class="btn btn-info" href="{{URL::to('banhang/tao-pnk')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo phiếu nhập</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
     Danh sách phiếu nhập kho
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
            
            <th>Mã phiếu nhập kho</th>
            <th>Nhân viên tạo phiếu</th>
            <th>Kho nhập</th>
            <th>Nhà cung cấp</th>
            <th>Ngày nhập kho</th>
            <th>Hành động</th>
          </tr>
        </thead>
        <tbody>
        
          @foreach($pnk as $dspnk)
          <tr>
            <?php 
            $ngaynhapkho=date("d-m-Y H:i:s", strtotime($dspnk->pnk_ngaynhapkho));
         
          ?>
            <td>PNK00{{ $dspnk->pnk_id }}</td>
            <td>{{ $dspnk->User->name}}</td>
            <td>{{ $dspnk->khohang->kho_ten}}</td>
            <td>{{ $dspnk->nhacungcap->ncc_ten}}</td>
            <td>{{ $ngaynhapkho}}</td>
             <td>
              <a href="{{URL::to('/banhang/chitiet-pnk/'.$dspnk->pnk_id)}}"  class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active" title="Xem chi tiết phiếu nhập kho"></i></a>
                <a href=" {{URL::to('/banhang/pdf-pnk/'.$dspnk->pnk_id)}}" class="active styling-edit" ui-toggle-class=""  >
                  <i class="fa fa-print" title="Xuất pdf phiếu nhập kho"></i></a>
                    <a href="{{ URL::to('/banhang/excel-pnk/'.$dspnk->pnk_id) }}" class="active styling-edit" ui-toggle-class="">
                        <i class="fa fa-file-excel-o" title="Xuất excel phiếu nhập kho"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection