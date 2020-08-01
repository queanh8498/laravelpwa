@extends('admin_banhang')

@section('admin_content')
<a type="button" name="taoddh" class="btn btn-success" href="{{URL::to('banhang/taodondathang')}}"> <i class="glyphicon glyphicon-plus"></i> Tạo đơn hàng</a><br><br>
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
                            <th>Nhân viên</th>
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
                                <td>{{ $ddh->name }}</td>
                                <td>{{ $ddh->ddh_ngaylap }}</td>
                                <td>{{ $ddh->bccn_hanno }}</td>
                                <td>{{ number_format($ddh->ddh_congnocu, 0, ',' , ',') }} VND</td>
                                <td>
                                    @if(($ddh->ddh_datra)==($ddh->TongCong))
                                        {{ number_format($ddh->ddh_congnomoi = 0) }} VND
                                    @else 
                                        {{ number_format($ddh->ddh_congnomoi = $ddh->TongCong - $ddh->ddh_datra,0,',',',') }} VND
                                    @endif
                                </td>
                                <td>{{ number_format($ddh->ddh_congnocu + $ddh->ddh_congnomoi, 0, ',' , ',') }} VND</td>
                                <td>
                                    <a href="{{URL::to('/banhang/chitietdondathang/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a> &nbsp;
                                    <a href=" {{URL::to('/banhang/pdf-ddh/'.$ddh->ddh_id)}}" class="fa fa-print" ></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection