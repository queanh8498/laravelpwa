@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa thông tin hàng hóa
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
                                <form role="form" action="{{URL::to('/banhang/sua-hh/'.$hh->hh_id)}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                             <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hàng hóa</label>
                                    <input type="text" data-validation="length" data-validation-length="min10"  data-validation-error-msg="Làm ơn điền ít nhất 10 ký tự" name="hh_ten" class="form-control" id="exampleInputEmail1" placeholder="Tên hàng hóa" value="{{$hh->hh_ten}}" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="hh_hinh" class="form-control" id="exampleInputEmail1">
                                    <img src="{{URL::to('upload/hanghoa/'.$hh->hh_hinh)}}" height="100" width="100">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền đơn giá" name="hh_dongia" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" value="{{$hh->hh_dongia}}" >
                                </div>
               
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Kho</label>
                                      <select name="kho_id" class="form-control input-sm m-bot15">
                                        @foreach($khohang as $key => $dskho)
                                            @if($dskho->kho_id==$hh->kho_id)
                                            <option selected value="{{$dskho->kho_id}}">{{$dskho->kho_ten}}</option>
                                            @else
                                            <option value="{{$dskho->kho_id}}">{{$dskho->kho_ten}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                   <div class="form-group">
                                    <label for="exampleInputPassword1">Nhóm</label>
                                      <select name="nhom_id" class="form-control input-sm m-bot15">
                                        @foreach($nhom as $key => $dsnhom)
                                            @if($dsnhom->nhom_id==$hh->nhom_id)
                                            <option selected value="{{$dsnhom->nhom_id}}">{{$dsnhom->nhom_ten}}</option>
                                            @else
                                            <option value="{{$dsnhom->nhom_id}}">{{$dsnhom->nhom_ten}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                               <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin</label>
                                    <textarea style="resize: none" rows="8" class="form-control"
                               name="hh_thongtin" id="ckeditor" placeholder="Thông tin hàng hóa">{{$hh->hh_thongtin}}</textarea>
                                </div>
                           
                                 <button type="submit" name="suahh" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
@endsection
