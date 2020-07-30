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
                                    <label for="exampleInputEmail1">Mã phiếu nhập kho</label>
                                    <input type="text" name="pnk_ten" class="form-control" id="pnk_ten"  value="{{'PNK00'.$pnk->pnk_id}}">
                                
                                </div>
                                <input type="hidden" name="pnk_id" class="form-control" id="pnk_id"  value="{{$pnk->pnk_id}}">
                         <div class="form-group">
                                    <label for="exampleInputEmail1">Nhà cung cấp</label>
                                     <input type="text" name="ncc_ten" class="form-control" id="ncc_ten"  value="{{$pnk->nhacungcap->ncc_ten}}">
                                     <input type="hidden" id="ncc_id" name="ncc_id" value="{{$pnk->ncc_id}}" >
                          </div>
                          
                          
                 <span id="result"></span>
                   <table class="table table-bordered table-striped" id="user_table">

               <thead>
                <tr>
                      <th with="5%"></th>
                    <th with="15%">Tên hàng hóa</th>
                    <th with="10%">Số lượng</th>
                     <th with="10%">Số lượng trả</th>
                      <th  with="10%" >Đơn giá</th>
                       <th   with="10%" >Thành tiền</th>
                    <th >Hành động</th>
                </tr>
               </thead>
               <tbody>
             
               </tbody>
               <tfoot>
                <tr>
                                <td colspan="6" align="right">&nbsp;</td>
                                <td>
                  @csrf
                  <input type="submit" name="save" id="save" class="btn btn-primary" value="Lưu" />

                 </td>
                </tr>
               </tfoot>
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
            url: '{{ route("dynamic-field.insertncc") }}',
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
                $('#save').attr('disabled', true);
            }
        })
 });

});
  $(document).ready(function(){

 var count = 0;

html = '@foreach($ctptncc as $key =>$value)';
count++;
  html += '<tr>';
     html += '<td><input type="checkbox" name="check" class="check" id="check'+count+'" value="'+count+'"></td>';
        html += '<td><input type="text" name="hh_ten[]" class="form-control hh_ten" id="hh_ten'+count+'" value="{{$value->hh_ten}}"></td>';
        html += '<input type="hidden" name="hh_id[]" class="form-control hh_id" id="hh_id'+count+'" data-sub_hh_id="'+count+'" value="{{$value->hh_id}}">';
        html += '<td><input type="text" name="ctpn_soluong[]" class="form-control ctpn_soluong" id="ctpn_soluong'+count+'"  value="{{$value->ctpn_soluong}}"></td>';
         html += '<td><input type="text" name="ctncc_soluong[]" class="form-control ctncc_soluong" id="ctncc_soluong'+count+'"  ></td>';
        html += '<td><input type="text"  name="ctncc_dongia[]" class="form-control ctncc_dongia"  id="ctncc_dongia'+count+'" value="{{$value->ctpn_dongia}}" ></td>';
         html += '<td><input type="text"  name="ctptncc_tt[]" class="form-control ctptncc_tt"  id="ctptncc_tt'+count+'" value="0"  ></td>';
          html += '<td></td></tr> @endforeach';
     
 
    $('tbody').html(html);
     $('#save').attr('disabled', true);
    $('.hh_ten').prop('disabled', true);
    $('.hh_id').prop('disabled', true);
    $('.ctpn_soluong').prop('disabled', true);
    $('.ctncc_soluong').prop('disabled', true);
    $('.ctncc_dongia').prop('disabled', true);
    $('.ctptncc_tt').prop('disabled', true);
     $("input[type='checkbox'][name='check']").change(function() {
           
           var check=$(this).val();
          
           if ($(this).is(":checked")) {
            console.log(check);
            $('#hh_id'+check).prop('disabled', false);
            $('#ctpn_soluong'+check).prop('disabled', false);
            $('#ctncc_soluong'+check).prop('disabled', false);
            $('#ctncc_dongia'+check).prop('disabled', false);
            $('#ctptncc_tt'+check).prop('disabled', false);
              $('#save').attr('disabled', false);
             $('#hh_id'+check).prop("readonly", true);
             $('#ctpn_soluong'+check).prop("readonly", true);
             $('#ctncc_soluong'+check).prop('disabled', false);
             $('#ctncc_dongia'+check).prop("readonly", true);
             $('#ctptncc_tt'+check).prop("readonly", true);
                   $(document).on('change','.ctncc_soluong',function () {
          if(parseInt($('#ctncc_soluong'+check).val())>parseInt($('#ctpn_soluong'+check).val())){
              alert('Số lượng trả hàng vượt quá quy định');
              $('#ctncc_soluong'+check).val($('#ctpn_soluong'+check).val());
          }
        else{
         var ctncc_soluong=$('#ctncc_soluong'+check).val();
         var ctncc_dongia=$('#ctncc_dongia'+check).val();
          var ctptncc_tt = ctncc_soluong*ctncc_dongia;
        $('#ctptncc_tt'+check).val(ctptncc_tt);}
         
    });
           }
             else{
                $('#save').attr('disabled', true);
            $('#hh_id'+check).prop('disabled', true);
            $('#ctpn_soluong'+check).prop('disabled', true);
            $('#ctncc_soluong'+check).prop('disabled', true);
            $('#ctncc_dongia'+check).prop('disabled', true);
            $('#ctptncc_tt'+check).prop('disabled', true);
             }
   
  });
});
</script>
@endsection