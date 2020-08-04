@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo hàng hóa 
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
                                <form role="form" action="{{URL::to('/banhang/tao-hh')}}" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                      <div class="form-group">
                           <label for="exampleInputEmail1">Người tạo hàng hóa:</label>
                            @if(isset(Auth::user()->name))
                             <input type="text"  class="form-control" value="{{Auth::user()->name}}" readonly="" >
                               <input type="hidden" id="nv_id" name="nv_id" value="{{Auth::user()->id}}" >
                              @endif
                        </div> 
                             <div class="form-group">
                                    <label for="exampleInputEmail1">Tên hàng hóa</label>
                                    <input type="text" data-validation="length" data-validation-length="min3"  data-validation-error-msg="Làm ơn điền ít nhất 3 ký tự" name="hh_ten" class="form-control" id="exampleInputEmail1" placeholder="Tên hàng hóa" >
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputEmail1">Hình ảnh</label>
                                    <input type="file" name="hh_hinh" class="form-control" id="exampleInputEmail1">
                                </div>
                                
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn giá</label>
                                    <input type="text" data-validation="number" data-validation-error-msg="Làm ơn điền đơn giá" name="hh_dongia" class="form-control" id="exampleInputEmail1" placeholder="Giá sản phẩm" >
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Đơn vị tính</label>
                                    <input type="text" data-validation="length" data-validation-length="min1"  data-validation-error-msg="Làm ơn điền ít nhất 1 ký tự" name="hh_donvitinh" class="form-control" id="exampleInputEmail1" placeholder="Đơn vị tính" >
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">kho</label>
                                      <select name="kho_id" class="form-control input-sm m-bot15">
                                        @foreach($khohang as $key => $dskho)
                                            <option value="{{$dskho->kho_id}}">{{$dskho->kho_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="ncc_id" class="form-control input-sm m-bot15" id="ncc_id">
                                           <option value="">--Chọn nhà cung cấp--</option>
                                        @foreach($ncc as $key => $dsncc)
                                            <option value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                  <div class="form-group">
                                    <label for="exampleInputPassword1">Nhóm</label>
                                      <select name="nhom_id" class="form-control input-sm m-bot15" id="nhom_id">
                                      <option value="">--Chọn nhóm hàng hóa--</option>          
                                    </select>
                                </div>
                               <div class="form-group">
                                    <label for="exampleInputPassword1">Thông tin</label>
                                    <textarea style="resize: none" rows="8" class="form-control"
                               name="hh_thongtin" id="ckeditor" placeholder="Thông tin hàng hóa"></textarea>
                                </div>
                           
                                 <button type="submit" name="taokho" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
<script type="text/javascript">
      $(document).on('change','#ncc_id',function () {
      var ncc_id=$(this).val();
   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/nhh-hh-theoncc')!!}',
        data:{'ncc_id':ncc_id},
      
        success:function(data){
         console.log(data);
             $('#nhom_id').html(data);
        },
        error:function(){

        }
      });
    });
</script>
@endsection