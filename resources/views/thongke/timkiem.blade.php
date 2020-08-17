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
        <div class="container-fluid">
            <div class="row">
                <div class="">
                    <form method="post" action="{{ route('thongke.timkiem') }}">
                        {{ csrf_field() }}
                
                        <div class="col-sm-5">
                            Từ :<input type="date" name="from_date" id="from_date" class="form-control" value="{{ old('from_date',$from_date) }}"/>
                        </div>
                        <div class="col-sm-5">
                            Đến :<input type="date" name="to_date" id="to_date" class="form-control"  value="{{ old('to_date',$to_date) }}"/>
                        </div>
                    
                        <!-- <div class="col-md-1">
                            <input type="hidden" name="kh_id" id="kh_id" class="form-control" value="">
                        </div> -->

                        <div class="col-md-1">
                            <br><button class="btn btn-outline-dark" type="submit">Tìm kiếm</button>
                        </div>

                    </form> 
                </div>
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            <div class="table-responsive" style="text-align: center;">
                <table class="table table-striped b-t b-light">
                    <tr>
                        <th>Tổng đơn hàng</th>
                        <th>Tổng tiền</th>
                        <th>Tổng công nợ</th>
                    </tr>
                    <tr>
                        @foreach($thongke_timkiem as $thongke_timkiem)
                            <td>{{ $thongke_timkiem->sodonhang}}</td>
                            <td>{{ number_format($thongke_timkiem->TongTienThuDuoc, 0, ',' , ',') }} đ</td>
                            <td>{{ number_format($thongke_timkiem->TongCongNo, 0, ',' , ',') }} đ</td>
                        @endforeach
                    </tr>
                </table>
            </div>
        </div>
    </div>
    
@endsection