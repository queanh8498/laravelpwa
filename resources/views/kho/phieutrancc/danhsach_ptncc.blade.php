@extends('admin_banhang')
@section('admin_content')
    
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách phiếu  trả nhà cung cấp
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
            
            <th>Mã phiếu trả nhà cung cấp</th>
             <th>Nhà cung cấp</th>
             <th>Tạo bởi phiếu nhập</th>
            <th>Nhân viên tạo phiếu</th>
            <th>Ngày lập</th>
            
            <th style="width:60px;"></th>
          </tr>
        </thead>
        <tbody>
        
          @foreach($ptncc as $dsptncc)
          <tr>
           
            <td>PTNCC00{{ $dsptncc->ptncc_id }}</td>
              <td>{{ $dsptncc->nhacungcap->ncc_ten }}</td>
             <td>PNK00{{ $dsptncc->pnk_id }}</td>
              <td>{{ $dsptncc->User->name }}</td>
               <td>{{ $dsptncc->ptncc_ngaylap }}</td>
               
             <td>
              <a href="{{URL::to('/banhang/chitiet-ptncc/'.$dsptncc->ptncc_id)}}"   class="active styling-edit" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i></a>
                  <a href=" {{URL::to('/banhang/pdf-ptncc/'.$dsptncc->ptncc_id)}}" class="active styling-edit" ui-toggle-class="" >
                    <i class="fa fa-print"></i></a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    
  </div>
</div>
@endsection