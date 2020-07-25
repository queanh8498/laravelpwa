@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo kho 
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/banhang/tao-kho')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên kho hàng</label>
                                    <input type="text" name="kho_ten" class="form-control" id="exampleInputEmail1" placeholder="Tên kho hàng">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ kho</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="kho_diachi"  placeholder="Địa chỉ kho" ></textarea>
                                </div>

                               
                         
                     
                           
                                 <button type="submit" name="taokho" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
@endsection