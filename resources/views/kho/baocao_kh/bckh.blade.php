@extends('admin_banhang')
@section('admin_content')
 <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
    <style> 

        .glyphicon{
            top: 4px;
            right: 6px;
        }
        .input-group{
            width: 100%;
        }
    </style>
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                       Báo cáo nhập xuất theo khách hàng
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">
                              <form role="form" method="post" id="dynamic_form" action="{{URL::to('/banhang/pdf-bckh')}}" > 
                                @csrf
                            <div class="position-center">
                                <div class="form-group">
                                    <label for="kh_sdt">Số điện thoại:</label>
                                    <input type="text" name="kh_sdt" class="form-control" id="kh_sdt" >
                                   
                                </div>
                                  <div  class="form-group">
                                    <label for="kh_ten">Khách hàng:</label>
                        
                                 
                                  <input type="text" name="kh_ten" class="form-control" id="kh_ten" readonly="" >
                                </div>
                               
                                  
                        
                                 
                                     <input type="hidden" name="kh_id" class="form-control" id="kh_id" >
                                     <label>Từ ngày: </label>    
                                    <div class="input-group date">
                                        <input type="text" class="date form-control" name="tungay" id="tungay"/>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                    </div>
                                  
                                 <label>Đến </label> 
                                      <div class="input-group date">
                                        <input type="text" class="date form-control" name="denngay" id="denngay"/>
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                      </div>
                                 
                            <br>
                              <input  type="button" name="save" id="save" class="btn btn-primary" value="Xem báo cáo" />

                            </div>
                          
                         
                          <br>
                           <table  class="table table-bordered table-striped" id="table" >

             
                           </table>
                           
                              <input  type='submit' name='taobaocaokh' id='taobaocaokh' class='btn btn-info' value="Xuất Pdf"> 
                                <button  type="submit" name="baocaokh" id='baocaokh' class="btn btn-info" formaction="{{URL::to('/banhang/excel-bckh')}}">Xuất Excel</button>
                             
                               </form>
                        </div>
                    </section>

            </div>
        </div>
     <script type="text/javascript">
        $('.date').datepicker({  
            format: 'dd-mm-yyyy'
        });  
    </script>
<script type="text/javascript">
   $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url:"{{ route('taobaocaokh.timsdt_bc_kh') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                
                    $('#kh_ten').val(data.kh_ten);
                    $('#kh_id').val(data.kh_id);
                
           
                }
            })
        }

        $(document).on('keyup', '#kh_sdt', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });
   $('#taobaocaokh').hide();
   $('#baocaokh').hide();
     $('#save').on('click', function(event){
        event.preventDefault();
       var a= $('#dynamic_form').serialize();
      
      // console.log(a);
          $.ajax({

        type:'post',
        url:'{!!URL::to('banhang/xem-bckh')!!}',
       data:$('#dynamic_form').serialize(),
        success:function(data){
          $("#table").html(data);

          $('#taobaocaokh').show();
          $('#baocaokh').show();
          if($('#check').val()=='Ngày không hợp lệ'){
              $('#taobaocaokh').hide();
              $('#baocaokh').hide();
          }
        },
        error:function(){

        }
      });
         
 });
</script>
@endsection
