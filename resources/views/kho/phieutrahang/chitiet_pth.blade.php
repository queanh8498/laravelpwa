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
           
            <th>Mã phiếu trả hàng</th>
            <th>Phiếu trả cho đơn hàng</th>
            <th>Nhân viên lập phiếu</th>
            <th>Khách trả hàng</th>
            <th>Địa chỉ khách trả hàng</th>
            <th>Ngày lập phiếu</th>
          
           
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>PTH00{{$pth->pth_id}}</td>
            <td>DDH00{{$pth->ddh_id}}</td>
             <td>{{$pth->User->name}}</td>
            <td>{{$pth->dondathang->khachhang->kh_ten}}</td>
             <td>{{$pth->dondathang->khachhang->kh_diachi}}</td>
            <td>{{$pth->pth_ngaylap}}</td>
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
            <th>STT</th>
            <th>Tên hàng hóa</th>
            <th>Đơn vị tính</th>
            <th>Nhà cung cấp</th>
            <th>Nhóm hàng hóa</th>
            <th>Số lượng</th>
            <th width="12%">Đơn giá</th>
            <th>Thành tiền</th>
           
         
          </tr>
        </thead>
        <tbody>
             <?php $i=1; ?>
          @foreach($ctth as $key => $dsctpth)
          <tr>
             <td> {{$i++}}</td>
            <td>{{$dsctpth->hh_ten}}</td>
            <td>{{$dsctpth->hh_donvitinh}}</td>
            <td>{{$dsctpth->ncc_ten}}</td>
            <td>{{$dsctpth->nhom_ten}}</td>
            <td>{{$dsctpth->ctth_soluong}}</td>
            <td>{{number_format($dsctpth->ctth_dongia,0,',','.')}}</td>
            <td>{{number_format($dsctpth->ctth_soluong*$dsctpth->ctth_dongia,0,',','.')}}</td>
            <?php
            $total=$total+($dsctpth->ctth_soluong*$dsctpth->ctth_dongia);
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