@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                       Báo cáo tồn kho tức thời
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">
                              <form role="form" method="post" id="dynamic_form" action="{{URL::to('/banhang/pdf-bctk')}}" > 
                                @csrf
                            <div class="position-center">
                                     <div class="form-group">
                                    <label for="exampleInputPassword1">Kho hàng</label>
                                      <select name="kho_id" class="form-control input-sm m-bot15" id="kho_id">
                                        @foreach($khohang as $key => $dskho)
                                            <option value="{{$dskho->kho_id}}">{{$dskho->kho_ten}}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                
                                 
                        
                              <input  type="button" name="save" id="save" class="btn btn-primary" value="Xem báo cáo" />

                            </div>
                          
                         
                          <br>
                           <table  class="table table-bordered table-striped" id="table" >

             
                           </table>
                           
                              <input  type='submit' name='taobaocaotk' id='taobaocaotk' class='btn btn-info' value="Tạo báo cáo"> 
                               </form>
                        </div>
                    </section>

            </div>
        </div>
<script type="text/javascript">
$('#taobaocaotk').hide();
     $('#save').on('click', function(event){
        event.preventDefault();
       var a= $('#dynamic_form').serialize();
      
       console.log(a);
          $.ajax({

        type:'post',
        url:'{!!URL::to('banhang/xem-bctk')!!}',
       data:$('#dynamic_form').serialize(),
        success:function(data){
          $("#table").html(data);

          $('#taobaocaotk').show();
          if($('#check').val()=='Ngày không hợp lệ'){
              $('#taobaocaotk').hide();
          }
        },
        error:function(){

        }
      });
         
 });
  
</script>
@endsection
