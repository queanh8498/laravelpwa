@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Tạo phiếu nhập kho
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
                                    <label for="exampleInputPassword1">Kho nhập hàng</label>
                                      <select name="kho_id" class="form-control input-sm m-bot15" id="kho_id">
                                        @foreach($kho as $key => $dskho)
                                            <option value="{{$dskho->kho_id}}">{{$dskho->kho_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="ncc_id" class="form-control input-sm m-bot15" id="ncc_id">
                                        <option value="">--Chọn nhà cung cấp--</option>
                                        @foreach($ncc_id as $key => $dsncc)
                                            <option value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
                 <span id="result"></span>
                 <table class="table table-bordered table-striped" id="user_table">

               <thead>
                <tr>
                   <th width="20%">Nhóm hàng hóa</th>
                    <th width="20%">Tên hàng hóa</th>
                    <th width="10%">Số lượng</th>
                      <th width="10%">Đơn giá</th>
                       <th width="10%">Thành tiền</th>
                    <th width="10%">Hành động</th>
                </tr>
               </thead>
               <tbody>

               </tbody>
               <tfoot>
                 <tr>
                <td colspan="4" class="text-right" >  <strong>Tính tổng:</strong> </td>
                <td><input type="text" name="sum" id="sum" class="form-control" readonly="" value="0"></td>
                  <td></td>
              </tr>

                <tr>
                                <td colspan="5" align="right">&nbsp;</td>
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

<script>

$(document).ready(function(){

 var count = 1;

 dynamic_field(count);

 function dynamic_field(number)
 {
  html = '<tr>';
     html += '<td><select name="nhom_id[]" class="form-control nhom_id" id="nhom_id'+count+'" data-sub_nhom_id="'+count+'">   <option value="">--Chọn nhóm hàng hóa--</option></select></td>';
        html += '<td><select name="hh_id[]" class="form-control hh_id" id="hh_id'+count+'" data-sub_hh_id="'+count+'"><option value="" >--Chọn hàng hóa--</option></select></td>';
        html += '<td><input type="text" name="ctpn_soluong[]" class="form-control ctpn_soluong" id="ctpn_soluong'+count+'"  placeholder="nhập số lượng" ></td>';
        html += '<td><input type="text"  name="ctpn_dongia[]" class="form-control ctpn_dongia"  id="ctpn_dongia'+count+'" value="0" readonly=""></td>';
          html += '<td><input type="text"  name="ctpn_tt[]" class="form-control ctpn_tt"  id="ctpn_tt'+count+'" value="0" readonly="" ></td>';
        if(number > 1)
        {
            html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Giảm</button></td></tr>';
            $('tbody').append(html);
        }
        else
        {   
            html += '<td><button type="button" name="add" id="add" class="btn btn-success">Thêm</button></td></tr>';
            $('tbody').html(html);
        }
 }

 $(document).on('click', '#add', function(){
  count++;
  dynamic_field(count);
   var ncc_id=$('#ncc_id').val();
    
   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/nhh-theoncc')!!}',
        data:{'ncc_id':ncc_id},
      
        success:function(data){
         console.log(data);
             $('#nhom_id'+count).html(data);
        },
        error:function(){

        }
      });
 });

 $(document).on('click', '.remove', function(){
  count--;
  $(this).closest("tr").remove();
  sum_pnk();
 });

 $('#dynamic_form').on('submit', function(event){
        event.preventDefault();
       var a= $(this).serialize();
       console.log(a);
         
        $.ajax({
            url: '{{ route("dynamic-field.insert") }}',
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
 $('.hh_id').each(function(){
          var count = 1;

          if($(this).val() == '')
          {
            error += '<p>Chọn hàng hóa tại dòng '+count+' </p>';
            return false;
          }

          count = count + 1;

        });
  $(document).on('change','#ncc_id',function () {
      var ncc_id=$(this).val();
    
   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/nhh-theoncc')!!}',
        data:{'ncc_id':ncc_id},
      
        success:function(data){
         console.log(data);
             $('.nhom_id').html(data);
          $('.hh_id option:selected ').text("--Chọn hàng hóa--");
            $('.ctpn_soluong').val("");
             $('.ctpn_dongia').val(0);
               $('.ctpn_tt').val(0);
        },
        error:function(){

        }
      });
    });
 $(document).on('change','.nhom_id',function () {
      var nhom_id=$(this).val();
      var kho_id=$('#kho_id').val();
      var sub_nhom_id=$(this).data('sub_nhom_id');
     $("#kho_id").find("option:not(:selected)").hide().attr("disabled",true);
   $.ajax({

        type:'get',
        url:'{!!URL::to('banhang/hanghoa')!!}',
        data:{'id':nhom_id,'kho_id':kho_id},
      
        success:function(data){
        // console.log(data);
             $('#hh_id'+sub_nhom_id).html(data);
        },
        error:function(){

        }
      });
    });
$(document).on('change','.hh_id',function () {
      var hh_id=$(this).val();
   var sub_hh_id=$(this).data('sub_hh_id');
     // console.log(sub_hh_id);
      var op="";
      $.ajax({
        type:'get',
        url:'{!!URL::to('banhang/dongia')!!}',
        data:{'id':hh_id},
        dataType:'json',//return data will be json
        success:function(data){
          // console.log(data);
      //    console.log("hh_dongia");
      //    console.log(data.hh_dongia);

          // here price is coloumn name in products table data.coln name
  
        $('#ctpn_dongia'+sub_hh_id).val(data.hh_dongia);
        $(document).on('change','.ctpn_soluong',function () {
         var ctpn_soluong=$('#ctpn_soluong'+sub_hh_id).val();
         var ctpn_dongia=$('#ctpn_dongia'+sub_hh_id).val();
          var ctpn_tt = ctpn_soluong*ctpn_dongia;
        $('#ctpn_tt'+sub_hh_id).val(ctpn_tt);
        sum_pnk();
    }); 
       
        var sl=$('#ctpn_soluong'+sub_hh_id).val();
        var dg=$('#ctpn_dongia'+sub_hh_id).val();
        var t = sl*dg;
        $('#ctpn_tt'+sub_hh_id).val(t);
        },
        error:function(){

        }
      });
    });

function sum_pnk(){
  var sum=0;
  $('.ctpn_tt').each(function(){
     var value=$(this).val();
    if(value.length !=0){
      sum+=parseFloat(value);

    }
  });
  $('#sum').val(sum);
}
</script>

@endsection