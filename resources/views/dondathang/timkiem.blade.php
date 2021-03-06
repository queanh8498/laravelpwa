@extends('admin_banhang')

@section('admin_content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style> 
        table{  
            border: 1px solid #ccc;
            border-collapse: collapse;
            text-align: center;
        }
        th{
            border-right: 1px solid #ccc;
        }
        td{
            border-right: 1px solid #ccc;
        }
        .input-group-addon{
            padding: 6px 18px;
        }
        span:hover{
            cursor: pointer;
        }
        .glyphicon{
            top: 4px;
            right: 6px;
        }
    </style>
    <a type="button" name="taoddh" class="btn btn-success" href="{{ URL::to('banhang/taodondathang') }}"> <i class="glyphicon glyphicon-plus"></i> Tạo đơn hàng</a><br><br>
    <div class="flash-message">
    @foreach(['warning','success','info','danger'] as $msg)
        @if(Session::has('alert-' . $msg))
            <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            </p>
        @endif
    @endforeach
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="">
                <form method="post" action="{{ route('dondathang.timkiem') }}">
                    {{ csrf_field() }}
            
                    <div class="col-sm-5">
                        <!-- Từ :<input type="date" name="from_date" id="from_date" class="form-control" value="{{ old('from_date',$from_date) }}" /> -->
                        Từ ngày : 
                            <div class="input-group date">
                                <input type="text" class="date form-control" name="from_date" id="from_date" value="{{ old('from_date',$from_date) }}"/>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    </div>
                    <div class="col-sm-5">
                        <!-- Đến :<input type="date" name="to_date" id="to_date" class="form-control"  value="{{ old('to_date',$to_date) }}"/> -->
                        Đến ngày: 
                            <div class="input-group date">
                                <input type="text" class="date form-control" name="to_date" id="to_date" class="form-control" value="{{ old('to_date',$to_date) }}"/>
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                    </div>

                    <div class="col-md-1">
                        <br><button class="btn btn-outline-dark" type="submit">Tìm kiếm</button>
                    </div>
                    <div class="col-md-1">
                        <br><a type="button" style="margin-left: 41px;" class="btn btn-outline-dark" href="{{ route('dondathang.time.excel', ['from_date'=>$from_date,'to_date'=>$to_date]) }}">Xuất Excel</a>
                    </div>

                </form> 
            </div>
        </div>
    </div>

    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Danh sách đơn hàng 
            </div>
            <br>
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
                        @foreach($chitiet_ddh_date as $ddh)
                            <?php
                                $ddh_ngaylap=date("d-m-Y", strtotime($ddh->ddh_ngaylap));
                                $bccn_hanno=date("d-m-Y", strtotime($ddh->bccn_hanno));
                            ?>
                            <tr>
                                <td>{{ $ddh->ddh_id }}</td>
                                <td>{{ $ddh->kh_ten }}</td>
                                <td>{{ $ddh_ngaylap }}</td>
                                <td>{{ $bccn_hanno }}</td>
                                <td>{{ number_format($ddh->ddh_congnocu, 0, ',' , ',') }} đ</td>
                                <td>
                                    @if(($ddh->ddh_datra)==($ddh->TongCong))
                                        {{ number_format($ddh->ddh_congnomoi = 0) }} đ
                                    @else 
                                        {{ number_format($ddh->ddh_congnomoi = $ddh->TongCong - $ddh->ddh_datra,0,',',',') }} đ
                                    @endif
                                </td>
                                <td>{{ number_format($ddh->ddh_congnocu + $ddh->ddh_congnomoi, 0, ',' , ',') }} đ</td>
                                <td width="16%">
                                    <a href="{{URL::to('/banhang/chitietdondathang/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-eye text-active" title="Xem chi tiết"></i></a> &nbsp;
                                    <a href=" {{URL::to('/banhang/pdf-ddh/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class="" ><i class="fa fa-print" aria-hidden="true" title="Phiếu bán hàng"></i></a>&nbsp;
                                    <a href="{{URL::to('/banhang/pdf-pxk/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-home" aria-hidden="true"  title="Phiếu xuất kho"></i></a>&nbsp;
                                    <a href="{{URL::to('/banhang/pdf-phieukynhan/'.$ddh->ddh_id)}}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-pencil" aria-hidden="true"  title="Phiếu lưu ký nhận"></i></a>&nbsp;
                                    <a href="{{ URL::to('/banhang/excel-ddh/'.$ddh->ddh_id) }}" class="active styling-edit" ui-toggle-class=""><i class="fa fa-file-excel-o" aria-hidden="true" title="Xuất file Excel"></i></a>&nbsp;
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('.date').datepicker({  
            format: 'dd-mm-yyyy'
        });  
    </script>
@endsection