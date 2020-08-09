@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thông tin nhà cung cấp
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
                                <form role="form" action="{{URL::to('/banhang/tao-ncc')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhà cung cấp</label>
                                    <input type="text" name="ncc_ten" class="form-control" id="exampleInputEmail1" placeholder="Tên nhà cung cấp">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Địa chỉ nhà cung cấp</label>
                                    <textarea style="resize: none" rows="8" class="form-control" name="ncc_diachi"  placeholder="Địa chỉ nhà cung cấp" ></textarea>
                                </div>
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại nhà cung cấp</label>
                                   <input  type="number" pattern="[-+]?[0-9]" name="ncc_sdt" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại nhà cung cấp">
                                </div>
                               
                         
                     
                           
                                 <button type="submit" name="taoncc" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
@endsection