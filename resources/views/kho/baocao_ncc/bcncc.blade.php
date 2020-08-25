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
                       Báo cáo nhập xuất tồn theo nhà cung cấp
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">
                              <form role="form" method="post" id="dynamic_form" action="{{URL::to('/banhang/pdf-bcncc')}}" > 
                                @csrf
                            <div class="position-center">
                                     <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="ncc_id" class="form-control input-sm m-bot15" id="ncc_id">
                                        @foreach($ncc as $key => $dsncc)
                                            <option value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                        @endforeach  
                                    </select>
                                </div>
                                
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
                           
                              <input  type='submit' name='taobaocaoncc' id='taobaocaoncc' class='btn btn-info' value="Xuất Pdf">
                               <button  type="submit" name="baocaoncc" id='baocaoncc' class="btn btn-info" formaction="{{URL::to('/banhang/excel-bcncc')}}">Xuất Excel</button>
                             
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
$('#taobaocaoncc').hide();
$('#baocaoncc').hide();
     $('#save').on('click', function(event){
        event.preventDefault();
       var a= $('#dynamic_form').serialize();
      
       //console.log(a);
          $.ajax({

        type:'post',
        url:'{!!URL::to('banhang/xem-bcncc')!!}',
       data:$('#dynamic_form').serialize(),
        success:function(data){
          $("#table").html(data);

          $('#taobaocaoncc').show();
          $('#baocaoncc').show();
          if($('#check').val()=='Ngày không hợp lệ'){
              $('#taobaocaoncc').hide();
               $('#baocaoncc').hide();
          }
        },
        error:function(){

        }
      });
         
 });
  
</script>
@endsection
