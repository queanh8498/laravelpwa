@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo phiếu trả hàng
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">
                             <form method="post" id="dynamic_form">
                                  
                        <div class="form-group">
                           <label for="exampleInputEmail1">Tên Nhân viên:</label>
                            @if(isset(Auth::user()->name))
                             <input type="text"  class="form-control" value="{{Auth::user()->name}}" readonly="" >
                               <input type="hidden" id="nv_id" name="nv_id" value="{{Auth::user()->id}}" >
                              @endif
                        </div>

                         <div class="form-group">
                                    <label for="exampleInputPassword1">Khách hàng</label>
                                      <select name="kh_id" class="form-control input-sm m-bot15" id="kh_id">
                                         <option value="0">--Chọn khách hàng--</option>
                                        @foreach($kh as $key => $dskh)
                                            <option value="{{$dskh->kh_id}}">{{$dskh->kh_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                              <div class="form-group" id="ddh_id">
                                            
                                </div>
                               
                 <span id="result"></span>
                  <table class="table table-bordered table-striped" id="user_table">

               
                 </table>
                </form>
                            <div class="position-center">
                             

                        </div>
                    </div>
                    </section>

            </div>
        </div>
<script type="text/javascript">
$(document).ready(function(){

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
       var a= $(this).serialize();
       
         console.log(a);
        $.ajax({
            url: '{{ route("dynamic-field.insertddh") }}',
            method:'post',
            data:$(this).serialize(),

            dataType:'json',
            beforeSend:function(){
                $('#save').attr('disabled','disabled');
            },
            success:function(data)
            {
                if(data.error)
                {
                    var error_html = '';
                    for(var count = 0; count < data.error.length; count++)
                    {
                        error_html += '<p>'+data.error[count]+'</p>';
                    }
                    $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                }
                else
                {
                 
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                }
                $('#save').attr('disabled', false);
            }
        })
 });

});
 $(document).on('change','#kh_id',function () {
      var kh_id=$(this).val();
  
        $.get("banhang/ddh/"+kh_id,function(data){
      
        $('#ddh_id').html(data);

        $('input[type="checkbox"]').change(function() {
          if ($(this).is(":checked")) {
             $("#kh_id").find("option:not(:selected)").hide().attr("disabled",true);
            $('input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
               var ddh_id=$(this).val();
              
                   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/checkddh')!!}',
         data:{'ddh_id':ddh_id,'kh_id':kh_id},
      
        success:function(data){
       // console.log(data);
      $('#user_table').html(data);
       $('.hh_id').prop('disabled', true);
       $('.ctth_soluong').prop('disabled', true);
       $('.ctdh_soluong').prop('disabled', true);
        $('.ctth_dongia').prop('disabled', true);
         $('.ctth_tt').prop('disabled', true);
           $('.ddh_id').prop('disabled', true);
            $('.hh_ten').prop('disabled', true);
        $("input[type='checkbox'][name='check']").change(function() {
           
           var check=$(this).val();
          
           if ($(this).is(":checked")) {
            console.log(check);
            $('#hh_id'+check).prop('disabled', false);
            $('#ctdh_soluong'+check).prop('disabled', false);
            $('#ctth_dongia'+check).prop('disabled', false);
            $('#ctth_tt'+check).prop('disabled', false);
            $('#ddh_id'+check).prop('disabled', false);

             $('#hh_id'+check).prop("readonly", true);
             $('#ctdh_soluong'+check).prop("readonly", true);
             $('#ctth_soluong'+check).prop('disabled', false);
             $('#ctth_dongia'+check).prop("readonly", true);
             $('#ctth_tt'+check).prop("readonly", true);
            
             $(document).on('change','.ctth_soluong',function () {
          if(parseInt($('#ctth_soluong'+check).val())>parseInt($('#ctdh_soluong'+check).val())){
              alert('Số lượng trả hàng vượt quá quy định');
              $('#ctth_soluong'+check).val($('#ctdh_soluong'+check).val());
          }
        else{
         var ctth_soluong=$('#ctth_soluong'+check).val();
         var ctth_dongia=$('#ctth_dongia'+check).val();
          var ctth_tt = ctth_soluong*ctth_dongia;
        $('#ctth_tt'+check).val(ctth_tt);}
         
    }); }else{
               $('#hh_id'+check).prop('disabled', true);
             $('#ctth_soluong'+check).prop('disabled', true);
            $('#ctdh_soluong'+check).prop('disabled', true);
             $('#ctth_dongia'+check).prop('disabled', true);
             $('#ctth_tt'+check).prop('disabled', true);
               $('#ddh_id'+check).prop('disabled', true);

             }
              
             

             
        });
            
        },
        error:function(){

        }
      });


          }
          else{
              $('input[type="checkbox"]').removeAttr('disabled');     
          }

});
    });
          });

 
  
</script>
@endsection