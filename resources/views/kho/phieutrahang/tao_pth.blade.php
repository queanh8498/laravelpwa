@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Thông tin phiếu trả hàng
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
                                    <label for="kh_sdt">Số điện thoại:</label>
                                    <input type="text" name="kh_sdt" class="form-control" id="kh_sdt" >
                                   
                                </div>
                                
                                <div  class="form-group">
                                    <label for="kh_ten">Khách hàng:</label>
                        
                                    <!-- <input type="text" onkeyup="checkInput(this.value)" name="kh_ten" class="form-control" id="kh_ten" > -->
                                    <!-- <input type="text" name="kh_id" class="form-control" id="kh_id" value=" <script> console.log(kh_ten) </script>" > -->
                                  <input type="text" name="kh_ten" class="form-control" id="kh_ten" >
                                </div>
                               
                                  
                        
                                    <!-- <input type="text" onkeyup="checkInput(this.value)" name="kh_ten" class="form-control" id="kh_ten" > -->
                                    <!-- <input type="text" name="kh_id" class="form-control" id="kh_id" value=" <script> console.log(kh_ten) </script>" > -->
                                     <input type="hidden" name="kh_id" class="form-control" id="kh_id" >
                            
                         
                      
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
  function formatNumber(nStr, decSeperate, groupSeperate) {
            nStr += '';
            x = nStr.split(decSeperate);
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + groupSeperate + '$2');
            }
            return x1 + x2;
        }
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
                $('#save').hide();
            }
        })
 });

});
    $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url:"{{ route('taopth.timsdt_khpth') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                  
                    $('#kh_ten').val(data.kh_ten);
                    $('#kh_id').val(data.kh_id);
        
           var kh_id=$('#kh_id').val();
            if($('#kh_ten').val()=="Không có khách hàng"){
             kh_id=$('#kh_id').val(0);
            }
        $.get("banhang/ddh/"+kh_id,function(data){
      
        $('#ddh_id').html(data);
         
        $('input[type="checkbox"]').change(function() {
          if ($(this).is(":checked")) {
             $('#kh_sdt').prop("readonly", true);
             $('#kh_ten').prop("readonly", true);
            $('input[type="checkbox"]:not(:checked)').attr('disabled', 'disabled');
               var ddh_id=$(this).val();
              
                   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/checkddh')!!}',
         data:{'ddh_id':ddh_id,'kh_id':kh_id},
      
        success:function(data){
       // console.log(data);
      $('#user_table').html(data);
       $('#save').attr('disabled', true);
       $('.hh_id').prop('disabled', true);
       $('.ctth_soluong').prop('disabled', true);
       $('.ctdh_soluong').prop('disabled', true);
        $('.ctth_dongia').prop('disabled', true);
         $('.ctth_tt').prop('disabled', true);
           $('.ddh_id').prop('disabled', true);
            $('.hh_ten').prop('disabled', true);
             $('.ctth_dongiath').prop('disabled', true);
        $("input[type='checkbox'][name='check']").change(function() {
           
           var check=$(this).val();
          
           if ($(this).is(":checked")) {
            console.log(check);
             $('#save').attr('disabled', false);
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
              var sum1=parseCurrency($('#sum').val())+parseCurrency($('#ctth_tt'+check).val());
            $('#sum').val(formatNumber(sum1, '.', ','));
             $(document).on('change','.ctth_soluong',function () {
          if(parseInt($('#ctth_soluong'+check).val())>parseInt($('#ctdh_soluong'+check).val())){
              alert('Số lượng trả phải nhỏ hơn hoặc bằng số lượng đã mua ');
              $('#ctth_soluong'+check).val(0);
          }
        else{
         var ctth_soluong=$('#ctth_soluong'+check).val();
         var ctth_dongia=$('#ctth_dongia'+check).val();
          var ctth_tt = ctth_soluong*ctth_dongia;
        $('#ctth_tt'+check).val(formatNumber(ctth_tt, '.', ','));
        sum_pnk();

    }
         
    }); }else{
                 var sum2=parseCurrency($('#sum').val())-parseCurrency($('#ctth_tt'+check).val());
            $('#sum').val(formatNumber(sum2, '.', ','));
             
               $('#hh_id'+check).prop('disabled', true);
             $('#ctth_soluong'+check).prop('disabled', true);
            $('#ctdh_soluong'+check).prop('disabled', true);
             $('#ctth_dongia'+check).prop('disabled', true);
             $('#ctth_tt'+check).prop('disabled', true);
              $('#ctth_tt'+check).val(0);
              $('#ctth_soluong'+check).val(0);
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
                  
 
                }
            })
        }

        $(document).on('keyup', '#kh_sdt', function(){
            var query = $(this).val();
            fetch_customer_data(query);
            
        });
    });

function parseCurrency( num ) {
    return parseFloat( num.replace( /,/g, '') );
}

 function sum_pnk(){
  var sum=0;
  $('.ctth_tt').each(function(){
     var value= parseCurrency($(this).val());
    if(value.length !=0){
      sum+=parseFloat(value);

    }
  });
  $('#sum').val(formatNumber(sum, '.', ','));
}


</script>
@endsection