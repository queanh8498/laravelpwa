@extends('layouts.app')


@section('title', 'Welcome')


@section('content')
<style>
	body{
		background: linear-gradient(to bottom, #0099ff 0%, #fff 100%);
	}
</style>

<div class="log-w3">
<div class="w3layouts-main">
	<h2>Đăng nhập</h2>
	 @if(count($errors)>0)
                       
		@foreach($errors->all() as $err)
			<span class="text-alert"> {{$err}}</span>
		@endforeach
		
	@endif

		@if(session('thongbao'))

			<span class="text-alert">{{session('thongbao')}}</span>
		
		@endif
		
		<form action="{{URL::to('/dangnhap')}}" method="post">
			{{ csrf_field() }}
			<input type="text"  class="ggg" name="email" placeholder="Email" >
			<input type="password" class="ggg" name="password" placeholder="Password" >

			<!-- <span><input type="checkbox" />Nhớ đăng nhập</span>
			<h6><a href="#">Quên mật khẩu</a></h6> -->
				<div class="clearfix"></div>
				<input type="submit" value="Đăng nhập" name="login">
		</form>
		{{-- <p>Don't Have an Account ?<a href="registration.html">Create an account</a></p> --}}
</div>
</div>
<script src="{{asset('backend/js/bootstrap.js')}}"></script>
<script src="{{asset('backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('backend/js/scripts.js')}}"></script>
<script src="{{asset('backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
<script src="{{asset('backend/js/jquery.scrollTo.js')}}"></script>
@endsection
