@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa thông tin kho hàng 
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
                                <form role="form" action="{{URL::to('/banhang/sua-kho/'.$khohang->kho_id)}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên kho hàng</label>
                                    <input type="text" name="kho_ten" class="form-control" id="exampleInputEmail1"  value="{{$khohang->kho_ten}}">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ kho</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="kho_diachi"> {{$khohang->kho_diachi}} </textarea>
                                </div>

                               
                         
                     
                           
                                 <button type="submit" name="suakho" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
@endsection