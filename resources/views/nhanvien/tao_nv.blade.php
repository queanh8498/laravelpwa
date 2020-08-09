@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo nhân viên
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
                                <form role="form" action="{{URL::to('/banhang/tao-nv')}}" method="post">
                                    {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhân viên</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Tên nhân viên" >
                                </div>
                              <div class="form-group">
                                    <label for="exampleInputEmail1">Địa chỉ </label>
                                    <input type="text" name="diachi" class="form-control" id="exampleInputEmail1" placeholder="Địa chỉ nhân viên">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Số điện thoại </label>
                                   <input  type="number" pattern="[-+]?[0-9]" name="sdt" class="form-control" id="exampleInputEmail1" placeholder="Số điện thoại nhân viên">
                                </div>
                             <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email nhân viên">
                                </div>
                                  <div class="form-group">
                                <input type="checkbox" id='checkbox1' value="1" >
                               <label >Quản lý bán hàng</label>
                                <input style="margin-left: 110px;" type="checkbox" id="checkbox2" value="3">
                               <label >Quản lý công nợ</label>
                                <input style="margin-left: 110px;" type="checkbox"  id="checkbox3" value="5">
                               <label >Quản lý kho</label>
                                    </div>
                                     <div class="form-group">
                                    <input type="hidden" name="quyen" value="" id="quyen">
                                </div>
                                 <div class="form-group">
                                <label>Mật khẩu</label>
                                <input type="password" class="form-control" name="password" placeholder="Nhập mật khẩu" />
                            </div>
                             <div class="form-group">
                                <label>Nhập lại Mật khẩu</label>
                                <input type="password" class="form-control" name="passwordAgain" placeholder="Nhập lại mật khẩu" />
                            </div>
                               
                                 <button type="submit" name="taonv" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
<script type="text/javascript">
         $('input:checkbox').change(function ()
     {
      var total = 0;
      var checkbox1 = parseInt($('#checkbox1:checked').val());
      var checkbox2 = parseInt($('#checkbox2:checked').val());
      var checkbox3 = parseInt($('#checkbox3:checked').val());
      if ($('#checkbox1').is(":checked")) {
        total=checkbox1;
      }
       if ($('#checkbox2').is(":checked")) {
        total=checkbox2;
      }
       if ($('#checkbox3').is(":checked")) {
        total=checkbox3;
      }
        if ($('#checkbox1').is(":checked")&& $('#checkbox2').is(":checked")) {
                total=checkbox1+checkbox2;
              }
               if ($('#checkbox1').is(":checked")&& $('#checkbox3').is(":checked")) {
                total=checkbox1+checkbox3;
              }
               if ($('#checkbox2').is(":checked")&& $('#checkbox3').is(":checked")) {
                total=checkbox2+checkbox3;
              }
   if ($('#checkbox1').is(":checked")&& $('#checkbox2').is(":checked") && $('#checkbox3').is(":checked") ) {
                total=checkbox1+checkbox2+checkbox3;
              }
      $("#quyen").val(total);

    });
</script>
@endsection