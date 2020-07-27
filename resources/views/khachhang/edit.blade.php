@extends('admin_banhang')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
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
                        
                <div class="panel-body">
                    <form method="post" action="{{URL::to('banhang/khachhang/update',['id'=>$kh->kh_id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label>Tên Khách hàng:</label>
                            <input type="text"  class="form-control" name="kh_ten" id="kh_ten" value="{{ $kh->kh_ten }}">
                        </div> 
                         <div class="form-group">
                            <label>Địa chỉ:</label>
                            <input type="text"  class="form-control" name="kh_diachi" id="kh_diachi" value="{{ $kh->kh_diachi }}">    
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input type="text"  class="form-control" name="kh_sdt" id="kh_sdt" value="{{ $kh->kh_sdt }}">    
                        </div>
                             
                        <div class="form-group">
                            <button class="btn btn-success float-right" type="submit">LƯU</button>
                        </div>
                    </form>
                            
                </div>
                    </section>

            </div>
        </div>
@endsection
  
    