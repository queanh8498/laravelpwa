@extends('admin_banhang')
@section('admin_content')
<style>
    .form-group.required.control-label:before{
   color: red;
   content: "(*)";
   position: absolute;
   font-weight: bold;
   margin-left: -10px;
}
label {
    margin-left:10px;
}

</style>
<div class="row">
    <div class="col-lg-1"></div>
            <div class="col-lg-8" >
                    <section class="panel" style="width:1000px">
                        <header class="panel-heading">
                           Chỉnh sửa Khách hàng
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                <div class="panel-body" style="width:1000px;">
                    <form method="post"  action="{{URL::to('banhang/khachhang/update',['id'=>$kh->kh_id]) }}">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group required control-label">
                                <label>Tên Khách hàng:</label>
                                    <input type="text"  class="form-control" name="kh_ten" id="kh_ten" value="{{ $kh->kh_ten }}" >
                                </div> 
                            </div>
                            <div class="col-md-6">
                                <div class="form-group required control-label">
                                    <label>Số điện thoại:</label>
                                    <input type="number"  pattern="[-+]?[0-9]" class="form-control" name="kh_sdt" id="kh_sdt" value="{{ $kh->kh_sdt }}">    
                                </div>
                            </div>
                            </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group required control-label">
                                        <label>Địa chỉ:</label>
                                        <input type="text"  class="form-control" name="kh_diachi" id="kh_diachi" value="{{ $kh->kh_diachi }}">    
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-info float-left" type="submit">LƯU</button>
                            <a style="margin-left:10px" class="btn btn-info float-left" href="{{URL::to('banhang/khachhang')}}">TRỞ VỀ</a>
                        </div>
                    </form>
                            
                </div>
                    </section>

            </div>
        </div>
@endsection
  
    