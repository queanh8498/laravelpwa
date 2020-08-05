@extends('admin_banhang')

@section('admin_content')
<a type="button" name="taoddh" class="btn btn-success" href="{{URL::to('banhang/taodondathang')}}"> <i class="glyphicon glyphicon-plus"></i> Tạo đơn hàng</a><br><br>
    <!-- <div class="container-fluid">
        <div class="row">
            <div class="">
                <form method="POST" action=""> -->
                <!-- <input type="text" name="search" class="form-control m-input" placeholder="Enter Country Name" /> -->
                <!-- {{ csrf_field() }}
            
                    <div class="col-sm-5">
                        Từ :<input type="date" name="from_date" id="from_date" class="form-control" />
                    </div>
                    <div class="col-sm-5">
                        Đến :<input type="date" name="to_date" id="to_date" class="form-control"  />
                    </div>
                
                    <div class="col-md-1">
                        <input type="hidden" name="kh_id" id="kh_id" class="form-control" value="">
                    </div>

                    <div class="col-md-1">
                        <br><button class="btn btn-outline-dark" type="submit">Tìm kiếm</button>
                    </div>

                </form> 
            </div>
        </div>
    </div> -->
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê danh mục đơn đặt hàng 
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light" id="dataTables-example">
                    <thead>
                        <tr>
                            <th>Mã đơn</th>
                            <th>Tên khách</th>
                            <th>Ngày lập</th>
                            <th>Ngày cho nợ</th>
                            <th>Công nợ cũ</th>
                            <th>Công nợ mới</th>
                            <th>Tổng nợ</th>
                            <th style="width:30px;">Chi tiết</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($danhsach_ddh as $ddh)
                            <tr>
                                <td>{{ $ddh->ddh_id }}</td>
                                <td>{{ $ddh->kh_ten }}</td>
                                <td>{{ $ddh->ddh_ngaylap }}</td>
                                <td>{{ $ddh->bccn_hanno }}</td>
                                <td>{{ number_format($ddh->ddh_congnocu, 0, ',' , ',') }} đ</td>
                                <td>
                                    @if(($ddh->ddh_datra)==($ddh->TongCong))
                                        {{ number_format($ddh->ddh_congnomoi = 0) }} đ
                                    @else 
                                        {{ number_format($ddh->ddh_congnomoi = $ddh->TongCong - $ddh->ddh_datra,0,',',',') }} đ
                                    @endif
                                </td>
                                <td>{{ number_format($ddh->ddh_congnocu + $ddh->ddh_congnomoi, 0, ',' , ',') }} đ</td>
                                <td width="15%">
                                    <a href="{{URL::to('/banhang/chitietdondathang/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-eye text-active"></i></a> &nbsp;
                                    <a href=" {{URL::to('/banhang/pdf-ddh/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class="" ><i class="fa fa-print" aria-hidden="true"></i></a>&nbsp;
                                    <a href="{{URL::to('/banhang/pdf-pxk/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-home" aria-hidden="true"></i></a>&nbsp;
                                    <a href="{{URL::to('/banhang/pdf-phieukynhan/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp;
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection