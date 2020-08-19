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
                   <div class="form-group" id="ck">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="ddh_giamchietkhau">Chiết khấu (%)</label>
                                    <input type="text" name="ddh_giamchietkhau" class="form-control" id="ddh_giamchietkhau" readonly="">
                                </div>
                                <div>
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_congnocu_dinhdang">Tổng công nợ cũ</label>
                                    <input type="text" name="ddh_congnocu_dinhdang" class="form-control" id="ddh_congnocu_dinhdang" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_datra">Cần trả khách</label>
                                    <input type="text" name="ddh_cantra" class="form-control" id="ddh_cantra" readonly="" value="0">
                                </div>
                                <div>
                                   
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_congnomoi_dinhdang">Tổng nợ </label>
                                    <input type="text" name="ddh_congnomoi_dinhdang" class="form-control" id="ddh_congnomoi_dinhdang" value="0" readonly>
                                </div>
                            </div>
                        </div>
                    @csrf
                          <input type='submit' name='save' id='save' class='btn btn-primary' value='Lưu'/>
                </form>
                            <div class="position-center">
                             

                        </div>
                    </div>
                    </section>

            </div>
        </div>
<script type="text/javascript">
   $('#ck').hide();// ẨN form-group có id=ck
   $('#save').hide();//Ẩn nút save 
    //Format từ số sang định dạng tiền tệ để hiển thị
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
       
        // console.log(a);
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
                      $('#save').attr('disabled', false);
                       //Nếu người dùng  kích hoạt checkbox và để trống số lượng trả tương ứng dòng có checkbox đó, dữ liệu sẽ không thể thêm thành công và hiển thị thông báo lỗi, nên nút save cần hiển thị để người dùng có thể tạo lại phiếu trả hàng
                }
                else
                {
                 
                    $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                     $('#save').hide();  //Khi tạo thành công nút save cần ẩn đi tránh trả 2 lần trên 1 đơn hàng
                }
               
            }
        })
 });

});
//Tìm số điện thoại hiển thị khách hàng và hiển thị tên khách hàng và đơn hàng của khách hàng đó, các đơn hàng chỉ hiển thị khi đơn hàng đó chưa thực hiện trả hàng trên hệ thống và không quá 7 ngày. Ngược lại sẽ thông báo không có đơn hàng mới trong 7 ngày. Nếu không có số điện thoại trong csdl thì sẽ hiển thị không có khách hàng.
    $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url:"{{ route('taopth.timsdt_khpth') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                   //Dữ liệu trả về sau khi người dùng nhập số điện thoại khách hàng trên hệ thống
                    $('#kh_ten').val(data.kh_ten);
                    $('#kh_id').val(data.kh_id);
                  
        
           var kh_id=$('#kh_id').val();
            if($('#kh_ten').val()=="Không có khách hàng"){   
            //Hiển thị vừa không có khách hàng, vừa không có đơn hàng trong 7 ngày do ở PhieutrahangController nếu kh_id=0 thì hiển thị không có đơn hàng trong 7 ngày
             kh_id=$('#kh_id').val(0);
            }
        $.get("banhang/ddh/"+kh_id,function(data){
      
        $('#ddh_id').html(data);
          //Nếu check vào sẽ hiển thị thông tin trên đơn hàng đồng thời disable các checkbox khác tránh tình trạng check nhiều đơn hàng hệ thống sẽ không thể hiển thị thông tin tương ứng   
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
       //Dữ liệu khi trả cần không kích hoạt tránh tình trạng khi chỉ cần trả 1 món hàng lại hoàn trả lại tất cả hàng hóa. Khi đổ dữ liệu vào table tại PhieutrahangController đã tạo ra các cột type hidden để gán giá trị tương ứng vào form-group id="ck" các giá trị tại trong id="ck" chỉ dùng để xem, các giá trị tinh toán và thêm vào csdl là các cột hidden.
       $('#save').attr('disabled', true);
       $('.hh_id').prop('disabled', true);
       $('.ctth_soluong').prop('disabled', true);
       $('.ctdh_soluong').prop('disabled', true);
       $('.ctth_dongia').prop('disabled', true);
       $('.ctth_tt').prop('disabled', true);
       $('.ddh_id').prop('disabled', true);
       $('.hh_ten').prop('disabled', true);
       $('.ctth_dongiath').prop('disabled', true);
       $('#ck').show();
       $('#save').show();
       $('#ddh_giamchietkhau').prop('disabled', true);
       $('#ddh_congnocu_dinhdang').prop('disabled', true);
       $('#ddh_congnomoi_dinhdang').prop('disabled', true);
       $('#ddh_cantra').prop('disabled', true);
       $('#ddh_giamchietkhau').val($('#gck').val());
      
       $('#ddh_congnocu_dinhdang').val(formatNumber($('#cnc').val(), '.', ','));
       
      // Chỉ hàng hóa có check thông tin sẽ được gửi để phieutrahangcontroller xử lý đưa vào csdl, những hàng hóa không check sẽ không được gửi
        $("input[type='checkbox'][class='check']").change(function() {
           
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
              //Khi người dùng click hoặc bỏ click check box giá trị thành tiền sẽ bị thay đổi nên phải cập nhật lại giá trị
             var sum1=parseCurrency($('#sum').val())+parseCurrency($('#ctth_tt'+check).val());
             $('#sum').val(formatNumber(sum1, '.', ','));
             var tong=parseCurrency($('#sum').val());
             var giamchietkhau=parseCurrency($('#sum').val())*($('#gck').val()/100);
             var cnc=$('#cnc').val();
             var  tgck=(tong-giamchietkhau);
             var  ctk=(tong-giamchietkhau)-cnc;
              //Nếu số tiền trả lại lớn hơn 0 thì sẽ trả lại tiền cho khách và cập nhật công nợ mới bằng 0
             if(ctk>=0){
             $('#ctk').val(ctk);
             $('#tien_gck').val(tgck);
             $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
             $('#cnm').val(0);
             $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
            else{
                //Nếu số tiền trả lại nhỏ hơn 0 (tiền nợ lớn hơn giá trị trả)=> cập nhật công nợ (do nhỏ hơn 0 nên phát sinh số âm cần *(-1) để đổi chiều)
                  $('#ctk').val(0);
                  $('#tien_gck').val(tgck);
                  $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
                  var ctk=ctk*-1;
                  $('#cnm').val(ctk);
                  $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
             $(document).on('change','.ctth_soluong',function () {
             if(parseInt($('#ctth_soluong'+check).val())>parseInt($('#ctdh_soluong'+check).val())){
              alert('Vượt quá số lượng đã mua');
              $('#ctth_soluong'+check).val(0);
             }
            else{
            var ctth_soluong=$('#ctth_soluong'+check).val();
            var ctth_dongia=$('#ctth_dongia'+check).val();
            var ctth_tt = ctth_soluong*ctth_dongia;
            $('#ctth_tt'+check).val(formatNumber(ctth_tt, '.', ','));
            sum_pnk();
            var tong=parseCurrency($('#sum').val());
            var giamchietkhau=parseCurrency($('#sum').val())*($('#gck').val()/100);
            var cnc=$('#cnc').val();
            var  tgck=(tong-giamchietkhau);
            var  ctk=(tong-giamchietkhau)-cnc;
            if(ctk>=0){
               $('#ctk').val(ctk);
               $('#tien_gck').val(tgck);
             $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
             $('#cnm').val(0);
             $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
            else{
                   $('#ctk').val(0);
                   $('#tien_gck').val(tgck);
               $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
                   var ctk=ctk*-1;
                    $('#cnm').val(ctk);
             $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
         

    }
         
    }); }else{
               //Khi bỏ click check box giá trị số lượng trả  cần đặt lại bằng 0(vì hàm sum_pnk() sẽ thực hiện cộng dồn nên nếu đặt các dòng uncheck số lượng trả khác 0  sẽ cộng dồn các cột có giá trị thành tiền có giá trị bằng 0 lẫn khác 0 gây ảnh hưởng kết quả). Giá trị nhỏ nhất số lượng trả bằng 0 thay vì 1 để tránh khi đặt lại cho kết quả sai.
              var sum2=parseCurrency($('#sum').val())-parseCurrency($('#ctth_tt'+check).val());
            $('#sum').val(formatNumber(sum2, '.', ','));
              var tong=parseCurrency($('#sum').val());
              var giamchietkhau=parseCurrency($('#sum').val())*($('#gck').val()/100);
              var cnc=$('#cnc').val();
              var  tgck=(tong-giamchietkhau);
              var  ctk=(tong-giamchietkhau)-cnc;
               if(ctk>=0){
             $('#ctk').val(ctk);
             $('#tien_gck').val(tgck);
             $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
             $('#cnm').val(0);
             $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
            else{
                   $('#ctk').val(0);
                    $('#tien_gck').val(tgck);
                    $('#ddh_cantra').val(formatNumber($('#ctk').val(), '.', ','));
                   var ctk=ctk*-1;
                    $('#cnm').val(ctk);
             $('#ddh_congnomoi_dinhdang').val(formatNumber($('#cnm').val(), '.', ','));
            }
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
// Định dạng tiền thành số để tính toán VD: 2,000,000=>2000000
function parseCurrency( num ) {
    return parseFloat( num.replace( /,/g, '') );
}
//Tính tổng tiền (không tính chiết khấu)
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