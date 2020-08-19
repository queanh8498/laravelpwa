@extends('admin_banhang')

@section('admin_content')
    <style> 
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
    </style>
    <div class="panel panel-default">
        
        <div class="panel-heading">
            Thống kê 
        </div>

        <div class="container-fluid">
            <div class="row">
                <form method="post" action="{{ route('thongke.timkiem') }}" style="margin-left: 115px;"> 
                    {{ csrf_field() }}
            
                    <div class="col-sm-5">
                        Từ :<input type="date" name="from_date" id="from_date" class="form-control" />
                    </div>
                    <div class="col-sm-5" style="margin-left: 33px;">
                        Đến :<input type="date" name="to_date" id="to_date" class="form-control" />
                    </div>

                    <div class="col-sm-1" style="margin-left: 18px;">
                        <br><button class="btn btn-outline-primary" type="submit">Tìm kiếm</button>
                    </div>

                </form> 
            </div>
        </div>
       
        <br>
        <div class="panel panel-default">
            @foreach($thongke as $thongke)
                <div class="row">
                    <div class="col-md-3" >
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 0px 20px 130px; background: linear-gradient(45deg,#39f 0%,#0040FF 100%); border-color: #2982cc;">
                            <div class="inner">
                                <p style="font-size: 1.3125rem; font-weight: bold;">{{ $thongke->sodonhang }}</p>

                                <p style="font-size: 14px; margin-top: 5px;">Tổng đơn hàng</p>
                            </div>
                            <div class="icon" style="margin-right: -120px; margin-top: 10px;">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 20px 20px 140px; background: linear-gradient(45deg,#39f 0%,#0040FF 100%); border-color: #2982cc;">
                            <div class="inner">
                            <p style="font-size: 1.3125rem; font-weight: bold;">{{ number_format($thongke->TongTienThuDuoc, 0, ',', ',') }} </p>

                            <p style="font-size: 14px; margin-top: 5px;">Tổng tiền thu được</p>
                            </div>
                            <div class="icon" style="margin-right: -135px; margin-top: 10px;">
                                <i class="fa fa-database" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="small-box" style="border-radius: 5px 5px 5px 5px; height: 100px; width: 250px; margin: 0px 10px 20px 150px; background: linear-gradient(45deg,#39f 0%,#0040FF 100%); border-color: #2982cc;">
                            <div class="inner">
                                <p style="font-size: 1.3125rem; font-weight: bold;">{{ number_format($thongke->TongCongNo, 0, ',', ',') }}</p>

                                <p style="font-size: 14px; margin-top: 5px;">Tổng nợ</p>
                            </div>
                            <div class="icon" style="margin-right: -140px; margin-top: 10px;">
                                <i class="fa fa-calendar-minus-o" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
        </div>

        <!-- <div class="container">
            <div class="row">
                <div class="col-md-4" style=" height: 300px;">
                    <div class="a" style="border: 1px solid black; height: 285px; margin-top: 6px;" >
                        <div class="bieudo1">abc</div>
                    </div>
                </div>
                <div class="col-md-4" style=" height: 300px;">
                    <div class="a" style="border: 1px solid black; height: 285px; margin-top: 6px;" >
                        <div class="bieudo1">abc</div>
                    </div>
                </div>
                <div class="col-md-4" style="height: 300px;">
                    <div class="a" style="border: 1px solid black; height: 285px; margin-top: 6px;" >
                        <div class="bieudo1">abc</div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
   
@endsection