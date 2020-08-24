@extends('admin_banhang')
@section('admin_content')

<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo Khách hàng mới
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                <div class="panel-body">
                    <form method="post" id="" action="{{ route('khachhang.store') }}">
                        {{ csrf_field() }}
                        <div class="form-group">
                           <label>Tên Khách hàng:</label>
                            <input type="text"  class="form-control" name="kh_ten" id="kh_ten" value="">
                        </div> 
                         <div class="form-group">
                            <label>Địa chỉ:</label>
                            <input type="text"  class="form-control" name="kh_diachi" id="kh_diachi" value="">    
                        </div>
                        <div class="form-group">
                            <label>Số điện thoại:</label>
                            <input type="number" pattern="[-+]?[0-9]" class="form-control" name="kh_sdt" id="kh_sdt" value="">    
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
  
    