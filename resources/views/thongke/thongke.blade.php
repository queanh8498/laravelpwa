@extends('admin_banhang')

@section('admin_content')
    <style> 
        table, th, td {  
            border: 1px solid #ccc;
            border-collapse: collapse;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            Thống kê 
        </div>
    </div>
    <div class="panel panel-default">
        <div class="table-responsive" style="text-align: center;">
            <table class="table table-striped b-t b-light">
                <tr>
                    <th>Tổng khách hàng</th>
                    <th>Tổng đơn hàng</th>
                    <th>Tổng tiền</th>
                    <th>Tổng công nợ</th>
                </tr>
                <tr>
                    <td>{{ $khachhang_count}}</td>
                    <td>{{ $donhang_count}}</td>
                    <td>{{ number_format($tongtienthuduoc->TongTienThuDuoc, 0, ',' , ',') }} đ</td>
                    <td>{{ number_format($tongno->TongNo, 0, ',' , ',') }} đ</td>
                </tr>
            </table>
        </div>
    </div>
@endsection