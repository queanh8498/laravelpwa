@extends('admin_banhang')
@section('admin_content')
<?php  $total=0;?>
  <div class="table-agile-info">
  
  <div class="panel panel-default">
    <div class="panel-heading">
    Chi tiết phiếu khách trả hàng
    </div>
    
    <div class="table-responsive">
                      
      <table class= "table table-bordered table-striped">
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
             <?php 
            $ngaylap=date("d-m-Y H:i:s", strtotime($pth->pth_ngaylap));
         
          ?>
            <td>PTH00{{$pth->pth_id}}</td>
            <td>DDH00{{$pth->ddh_id}}</td>
             <td>{{$pth->User->name}}</td>
            <td>{{$pth->dondathang->khachhang->kh_ten}}</td>
             <td>{{$pth->dondathang->khachhang->kh_diachi}}</td>
            <td>{{$ngaylap}}</td>
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
<table class= "table table-bordered table-striped" >
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


         <table align="right" width="400" height="200" style="color: #999; font-size: 14.4px; padding: 50px;">
                  
                    <tr>
                        <th>
                            Tổng tiền: 
                        </th>
                        <td>
                         {{number_format($total,0,',','.')}} VNĐ
                        </td>
                    </tr>
      
                    <tr>
                        <th>
                            Giảm chiết khấu: 
                        </th>
                        <td>
                          {{$pth->dondathang->ddh_giamchietkhau}} %
                        </td>
                    </tr>
                     <tr>
                        <th>
                           Tiền trả hàng:
                        </th>
                        <td>
                        {{number_format($total-$total*(($pth->dondathang->ddh_giamchietkhau)/100),0,',','.')}} VNĐ
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tiền cũ: 
                        </th>
                        <td>
                           {{number_format($pth->pth_tcn,0,',','.')}} VNĐ
                        </td>
                    </tr>
                     <tr>
                           <?php
 $cnkh=DB::table('congno_khachhang')->where('kh_id',$pth->dondathang->khachhang->kh_id)->first();
        ?>
       
                        <th>
                            Còn lại: 
                        </th>
                        <td>
                          {{number_format($cnkh->tongno,0,',','.')}} VNĐ
                        </td>
                    </tr>
                    <tr>
                        <th>
                           Cần trả khách: 
                        </th>
                        <td>
                         {{number_format($pth->pth_ctk,0,',','.')}} VNĐ
                        </td>
                    </tr>
                 
                  
                 
            </table>
      </table>
    </div>


  </div>
</div>
 
      
   
@endsection