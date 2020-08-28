@extends('admin_banhang')

@section('admin_content')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style>
        .footer{
            margin-top: 160px;
        }
        table, th, td {  
            border: 1px solid #ccc;
            border-collapse: collapse;
        }
        .small-box{
            margin-bottom: 10px;
            -webkit-transition: transform 0.9s ease;
            -o-transition: transform 0.9s ease;
            -moz-transition: transform 0.9s ease;
            transition: transform 0.9s ease;
        }
        /* .small-box:hover{
            -webkit-transform: scale(1.1);
            -moz-transform: scale(1.1);
            -ms-transform: scale(1.1);
            -o-transform: scale(1.1);
            transform: scale(1.1); 
        } */
        .small-box > .inner{
            padding: 10px 10px 3px 10px;
        }
        .small-box .icon {
            /* -webkit-transition: all .3s linear;
            -o-transition: all .3s linear;
            transition: all .3s linear; */
            position: absolute;
            top: -15px;
            right: 10px;
            z-index: 0;
            font-size: 40px;
            color: white;
            padding-right: 10px;
        }
        h5, p{
            color: white;

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
        .input-group{
            width: 95%;
        }
    </style>
    <div class="panel panel-default">
        <div class="panel-heading">
            Thống kê 
        </div>
        <div class="container-fluid" style="margin-top: 20px;">
            <div class="row">
                <form method="post" action="{{ route('thongke.timkiem') }}" style="margin-left: 115px;"> 
                    {{ csrf_field() }}
            
                    <div class="col-sm-5">
                        Từ ngày :
                        <div class="input-group date">
                            <input type="text" class="date form-control" name="from_date" id="from_date" value="{{ old('from_date',$from_date) }}" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        Đến ngày:
                        <div class="input-group date">
                            <input type="text"  class="date form-control" name="to_date" id="to_date" value="{{ old('to_date',$to_date) }}" />
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="col-sm-1">
                        <br><button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                    </div>

                </form> 
            </div>
        </div>
        <br>
        <div class="panel panel-default">
            
                <div class="row">
                    <div class="col-md-3" >
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 0px 20px 130px; background: #78c350; border-color: #2982cc;">
                            <div class="inner">
                                <p style="font-size: 1.3125rem; font-weight: bold;">{{ $sodonhang }}</p>

                                <p style="font-size: 14px; margin-top: 5px;">Tổng đơn hàng</p>
                            </div>
                            <div class="icon" style="margin-right: -120px; margin-top: 10px;">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 20px 20px 140px; background: #45bbe0; border-color: #2982cc;">
                            <div class="inner">
                            <p style="font-size: 1.3125rem; font-weight: bold;">{{ number_format($a_b_c, 0, ',' , ',') }} </p>

                            <p style="font-size: 14px; margin-top: 5px;">Doanh thu</p>
                            </div>
                            <div class="icon" style="margin-right: -140px; margin-top: 10px;">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 10px 20px 150px; background: #f06292; border-color: #2982cc;">
                            <div class="inner">
                                <p style="font-size: 1.3125rem; font-weight: bold;">{{ number_format($tongno, 0, ',' , ',') }}</p>

                                <p style="font-size: 14px; margin-top: 5px;">Tiền khách nợ</p>
                            </div>
                            <div class="icon" style="margin-right: -150px; margin-top: 10px;">
                                <i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            
        </div>
    </div>

    <script type="text/javascript">
        $('.date').datepicker({  
            format: 'dd-mm-yyyy'
        });  
    </script>
   
@endsection