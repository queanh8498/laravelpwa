@extends('admin_banhang')
@section('admin_content')
<?php  $total=0;?>
  <div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
    Chi tiết phiếu khách trả hàng
    </div>
    
    <div class="table-responsive">
                      
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Mã phiếu trả nhà cung cấp</th>
             <th>Nhà cung cấp</th>
             <th>Tạo bởi phiếu nhập</th>
            <th>Nhân viên tạo phiếu</th>
            <th>Ngày lập</th>
            <th>Trạng thái</th>
           
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>PTNCC00{{$ptncc->ptncc_id}}</td>
            <td>{{$ptncc->nhacungcap->ncc_ten}}</td>
            <td>{{$ptncc->pnk_id}}</td>
             <td>{{$ptncc->User->name}}</td>
            <td>{{$ptncc->ptncc_ngaylap}}</td>
             @if($ptncc->ptncc_trangthai==1)
                  <td>Chỉ xem phiếu</td>
                  @endif
          </tr>
     
        </tbody>
      </table>

    </div>
   
  </div>
</div>
<br>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
       Thông tin chi tiết phiếu khách trả hàng
    </div>
  
                         @if(session('thongbao'))
                            <span class="text-alert">
                                {{session('thongbao')}}
                            </span>
                        @endif                    
    <div class="table-responsive">
<table class="table table-striped b-t b-light" >
        <thead>
          <tr>
            <th>Tên hàng hóa</th>
            <th>Số lượng</th>
            <th width="12%">Đơn giá</th>
            <th>Thành tiền</th>
           
         
          </tr>
        </thead>
        <tbody>
          @foreach($ctncc as $key => $dsctptncc)
          <tr>
            <td>{{$dsctptncc->hh_ten}}</td>
            <td>{{$dsctptncc->ctncc_soluong}}</td>
            <td>{{$dsctptncc->ctncc_dongia }}</td>
            <td>{{$dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia}}</td>
            <?php
            $total=$total+($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia);
             ?>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>

     <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-4 text-center">
          <small class="text-muted inline m-t-sm m-b-sm" style="font-size: 20px;"><b>Tổng Tiền:</b> </small>
          
          <small style="font-size: 20px;">{{number_format($total).' '.'VNĐ'}} </small>
        
        </div>
        
  
      </div>
     
      
    </footer>
  </div>
</div>
 

@endsection