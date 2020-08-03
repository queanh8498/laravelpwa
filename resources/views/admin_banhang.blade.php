<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('backend/css/bootstrap.min.css')}}" >
<link rel="stylesheet" href="{{asset('backend/bootstrap/css/bootstrap.min.css')}}" >

<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('backend/css/monthly.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/DataTables/datatables.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('backend/css/datatables.min.css')}}">
<!-- //calendar -->
<!-- //font-awesome icons -->
<script src="{{asset('backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('backend/js/raphael-min.js')}}"></script>
<script src="{{asset('backend/js/morris.js')}}"></script>
<base href="{{asset('')}}">
</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="#" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<!--logo end-->

<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="{{('backend/images/admin.png')}}">
                    @if(isset(Auth::user()->name))
                <span class="username">
                	
                    {{Auth::user()->name}}
                </span>
                @endif
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
         
                <li><a href="{{URL::to('/dangxuat')}}"><i class="fa fa-key"></i>Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('banhang/tongquanbanhang')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                       <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý kho</span>
                    </a>
                    <ul class="sub">
                      <li><a href="{{URL::to('banhang/danhsach-kho')}}">Danh mục kho xuất hàng</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-ncc')}}">Danh mục nhà cung cấp</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-nhom')}}">Danh mục nhóm hàng hóa</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-hh')}}">Danh mục hàng hóa</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-pnk')}}">Phiếu nhập kho</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-pth')}}">Phiếu khách trả hàng</a></li>
                        <li><a href="{{URL::to('banhang/danhsach-ptncc')}}">Phiếu trả nhà cung cấp</a></li>
                        <li><a href="{{URL::to('banhang/tao-bcncc')}}">Báo cáo nhập-xuất-tồn theo nhà cung cấp</a></li>
                        
                      
                    </ul>
                </li>
                  <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý bán hàng</span>
                    </a>
                    <ul class="sub">
                        <li><a href="{{URL::to('banhang/khachhang')}}">Khách hàng</a></li>
                        <li><a href="{{URL::to('banhang/danhsachdondathang')}}">Đơn hàng</a></li>
                        <li><a href="#">Hàng hóa còn tồn kho</a></li>
                   
                        
                      
                    </ul>
                </li>
                  
             
  </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
        @yield('admin_content')
    </section>
 <!-- footer -->
		  <div class="footer">
			<div class="wthree-copyright">
			  <p>© 2017 Visitors. All rights reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
			</div>
		  </div>
  <!-- / footer -->
</section>
<!--main content end-->
</section>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend/DataTables/datatables.min.js')}}"></script>
<script src="{{asset('backend/js/datatables.min.js')}}"></script>
<script src="{{asset('backend/js/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/js/vfs_fonts.js')}}"></script>
<script src="{{asset('backend/js/jquery.form-validator.min.js')}}"></script>
<script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
           
            if(action=='cate_id'){
                result = 'product_cate';
            }
            $.ajax({
                url : '{{url('/get-category')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);     
                }
            });
        });
        });
          
    </script>
<script>
    $(document).ready(function() {
                $('#dataTables-example').DataTable({
                    responsive: true,
                    order: [
                        [0, 'asc']
                    ],
                    dom: 'lBfrtip',
   buttons: [
    'excel', 'csv', 'pdf', 'copy', 'print'
   ],
                    'language': {
                        'info': 'Hiển thị _START_ đến _END_ của _TOTAL_ danh sách',
                        'lengthMenu': "Hiển thị _MENU_ danh sách",
                        "emptyTable": "Không có dữ liệu trong bảng",
                        "paginate": {
                            "previous": "Trước",
                            "next": "Sau",
                            "infoEmpty": "Không có dữ liệu"

                        },
                        "search": "Lọc / Tìm kiếm:"
                    },
                });
            });
    </script>
<script type="text/javascript">
	$.validate({

	});
</script>
<script>
	CKEDITOR.replace('ckeditor');
	CKEDITOR.replace('ckeditor1');
	CKEDITOR.replace('ckeditor2');
	CKEDITOR.replace('ckeditor3');
	CKEDITOR.replace('ckeditor4');
	CKEDITOR.replace('ckeditor5');
    CKEDITOR.replace('ckeditor6');
    CKEDITOR.replace('ckeditor7');
    CKEDITOR.replace('ckeditor8');
    CKEDITOR.replace('ckeditor9');
    CKEDITOR.replace('ckeditor10');
    CKEDITOR.replace('ckeditor11');
    CKEDITOR.replace('ckeditor12');
    CKEDITOR.replace('ckeditor13');
    CKEDITOR.replace('ckeditor14');
</script>
<!-- morris JavaScript -->	
<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="{{asset('backend/js/monthly.js')}}"></script>
    <script type="text/javascript" src="{{asset('backend/js/canvasjs.min.js')}}"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
    
</body>
</html>
