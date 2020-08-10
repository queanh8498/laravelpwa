@extends('admin_banhang')
@section('admin_content')
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
                                   <input type="date" class="form-control" id="tungay" name="tungay">
                                  
                                 <label>Đến </label> 
                                      <input type="date" class="form-control" id="denngay" name="denngay">
                                 
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
$('#taobaocaoncc').hide();
$('#baocaoncc').hide();
     $('#save').on('click', function(event){
        event.preventDefault();
       var a= $('#dynamic_form').serialize();
      
       console.log(a);
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
