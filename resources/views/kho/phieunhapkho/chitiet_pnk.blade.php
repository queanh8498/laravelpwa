@extends('admin_banhang')
@section('admin_content')
<?php  $total=0;?>
  <div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
    Chi tiết phiếu nhập kho
    </div>
    
    <div class="table-responsive">
                      
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên khách hàng</th>
            <th>Kho hàng</th>
            <th>Địa chỉ kho</th>
            
           
          </tr>
        </thead>
        <tbody>
        
          <tr>
            <td>{{$pnk->User->name}}</td>
            <td>{{$pnk->khohang->kho_ten}}</td>
              <td>{{$pnk->khohang->kho_diachi}}</td>
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
       Thông tin chi tiết phiếu nhập kho
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
            <th>Mã phiếu nhập</th>
            <th>Tên hàng hóa</th>
            <th>Số lượng</th>
            <th width="12%">Đơn giá</th>
            <th>Thành tiền</th>
           
         
          </tr>
        </thead>
        <tbody>
          @foreach($ctpn as $key => $dsctpn)
          <tr>
           
            <td>{{$dsctpn->pnk_id}}</td>
            <td>{{$dsctpn->hh_ten}}</td>
            <td>{{$dsctpn->ctpn_soluong}}</td>
            <td>{{$dsctpn->ctpn_dongia }}</td>
            <td>{{$dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia}}</td>
            <?php
            $total=$total+($dsctpn->ctpn_soluong*$dsctpn->ctpn_dongia);
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