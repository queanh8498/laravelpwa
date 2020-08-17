@extends('admin_banhang')

@section('admin_content')
    <style>
        td {
            vertical-align: top;
        }
        #table1, #table2{
            display: none;
        }
    </style>

    <a class="btn btn-light" onclick='show(1);'><i class="glyphicon glyphicon-plus"></i> Tạo khách hàng mới</a>
    <br/>
	@if(count($errors)>0)
		<span class="text-alert">
		@foreach($errors->all() as $err)
			{{$err}}<br>
			@endforeach
		</span>
	@endif
    <br />
    <div class="flash-message">
        @foreach(['warning','success','info','danger'] as $msg)
            @if(Session::has('alert-' . $msg))
                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }}
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                </p>
            @endif
        @endforeach
    </div>
    <br />
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Tạo đơn hàng 
                </header>
                
                <div class="panel-body">
				    <!-- #table1 -->
                    <div id="table1"> 
                        <form method="post" id="" action="{{ route('taodondathang.store_kh_moi') }}">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-sm-1">
                                </div> 
                                <div class="col-sm-5">
                                    <label>Tên Khách hàng:</label>
                                    <input type="text"  class="form-control" name="kh_ten_" id="kh_ten_" value="">
                                </div> 
                                <div class="col-sm-5">
                                    <label>Số điện thoại:</label>
                                    <input type="text"  class="form-control" name="kh_sdt_" id="kh_sdt_" value="">    
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-10">
                                    <label>Địa chỉ:</label>
                                    <input type="text"  class="form-control" name="kh_diachi_" id="kh_diachi_" value="">    
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>

                            <div class="col-sm-1">
                            </div>

                            <br>
                            <div class="row">
                                <div class="col-sm-1">
                                </div>
                                <div class="col-sm-8">
                                    <button class="btn btn-dark btn-sm btn-block" type="submit">LƯU KHÁCH HÀNG MỚI</button>
                                </div>
                                <div class="col-sm-2">
                                    <a class="btn btn-light btn-sm btn-block" onclick='show(2);'>ẨN</a>
                                </div>
                                <div class="col-sm-1">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- #table2 -->
                    <div id="table2">  

                    </div>
                    <form id="dynamic_form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="kh_sdt">SDT:</label>
                                    <input type="text" name="kh_sdt" class="form-control" id="kh_sdt" >             
                                </div>
                                <div class="col-md-6">
                                    <label for="kh_ten">Khách hàng:</label>
                                    <input type="text" name="kh_ten" class="form-control" id="kh_ten" readonly >
                                        <!-- <input type="text" name="kh_id" class="form-control" id="kh_id" value=" <script> console.log(kh_ten) </script>" > -->
                                        <!-- <span id="kh_ten"></span> -->
                                </div>
                                <div class="col-md-6">
                                    <input type="hidden" name="kh_id" class="form-control" id="kh_id" >
                                </div>
                            </div>         
                        </div>
                                
                        <div class="form-group">
                            <label for="id">Nhân viên</label>
                                @if(isset(Auth::user()->name))
                                    <input type="text"  class="form-control" value="{{Auth::user()->name}}" readonly="" >
                                    <input type="hidden" id="id" name="id" value="{{Auth::user()->id}}" >
                                @endif
                        </div>
                                
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                        <label for="ddh_ngaylap">Ngày lập</label>
                                        <input type="date" name="ddh_ngaylap" class="form-control" id="ddh_ngaylap" >
                                </div>
                                <div class="col-md-6">
                                    <label for="ddh_thoihan">Thời hạn thanh toán (Số ngày)</label>
                                    <input type="number" name="ddh_thoihan" class="form-control" id="ddh_thoihan" value="30" >
                                </div>
                            </div>              
                        </div>

                        <table class="table table-bordered table-striped" id="user_table">
                            <thead>
                                <tr>
                                    <th width="20%">Nhóm hàng hóa</th>
                                    <th width="20%">Tên hàng hóa</th>
                                    <th width="10%">Số lượng trong kho</th>
                                    <th width="7%">Số lượng</th>
                                    <!-- <th width="15%">Đơn giá</th> -->
                                    <th width="15%">Đơn giá</th>
                                    <!-- <th width="15%">Thành tiền</th> -->
                                    <th width="15%">Thành tiền</th>
                                    <th width="7%">Hành động</th>
                                </tr>
                            </thead>

                            <tbody>

                            </tbody>
                                    
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-right">
                                        <strong>Tiền hàng:</strong> 
                                    </td>
                                    <!-- <td> -->
                                        <input type="hidden" id="estimated_ammount" class="estimated_ammount" value="0" readonly>
                                    <!-- </td> -->
                                    <td colspan="2">
                                        <input type="text" id="estimated_ammount_dinhdang" class="estimated_ammount_dinhdang" value="0" readonly>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="ddh_congnocu_dinhdang">Công nợ cũ</label>
                                    <input type="text" name="ddh_congnocu_dinhdang" class="form-control" id="ddh_congnocu_dinhdang" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_giamchietkhau">Chiết khấu (%)</label>
                                    <input type="text" name="ddh_giamchietkhau" class="form-control" id="ddh_giamchietkhau">
                                </div>
                                <div>
                                    <!-- <label for="ddh_tongtiensauchietkhau">Tổng tiền</label> -->
                                    <input type="hidden" name="ddh_tongtiensauchietkhau" class="form-control" id="ddh_tongtiensauchietkhau">
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_tongtiensauchietkhau_dinhdang">Tổng tiền</label>
                                    <input type="text" name="ddh_tongtiensauchietkhau_dinhdang" class="form-control" id="ddh_tongtiensauchietkhau_dinhdang" readonly>
                                </div>
                                <div>
                                    <!-- <label for="ddh_congnocu">Công nợ cũ</label> -->
                                    <input type="hidden" name="ddh_congnocu" class="form-control" id="ddh_congnocu" readonly>
                                </div>
                                <div class="col-md-3">
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_datra">Khách đã trả</label>
                                    <input type="text" name="ddh_datra" class="form-control" id="ddh_datra">
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_thunocu">Thu nợ cũ</label>
                                    <input type="text" name="ddh_thunocu" class="form-control" id="ddh_thunocu" readonly>
                                </div>
                                <div>
                                    <!-- <label for="ddh_congnomoi">Công nợ mới</label> -->
                                    <input type="hidden" name="ddh_congnomoi" class="form-control" id="ddh_congnomoi" readonly>
                                </div>
                                <!-- <div class="col-md-3">
                                    <label for="ddh_congnomoi_dinhdang">Công nợ mới</label>
                                    <input type="text" name="ddh_congnomoi_dinhdang" class="form-control" id="ddh_congnomoi_dinhdang" readonly>
                                </div> -->
                                <div class="col-md-3">
                                    <label for="ddh_congnomoihienra">Công nợ mới</label>
                                    <input type="text" name="ddh_congnomoihienra" class="form-control" id="ddh_congnomoihienra" readonly>
                                </div>
                                <div class="col-md-3">
                                    <label for="ddh_tongno">Tổng nợ</label>
                                    <input type="text" name="ddh_tongno" class="form-control" id="ddh_tongno" readonly>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <span id="result"></span>
                        <button type="submit" name="taodondathang" class="btn btn-info">Lưu và tiếp tục tạo mới</button>
                        <a type="button" name="taoddh" class="btn btn-success" href="{{ URL::to('banhang/danhsachdondathang') }}">Trở về</a><br>
                    </form>
                </div>
            </section>
        </div>
    </div>

<script>
    
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
        var count = 1;
        dynamic_field(count);
        function dynamic_field(number){
            html = '<tr>';
            html += '<td><select name="nhom_id[]" class="form-control nhom_id" data-sub_nhom_id="'+count+'">   <option value="">--Chọn nhóm hàng hóa--</option>@foreach($nhom as $key => $dsnhom)'+
                '<option value="{{ $dsnhom->nhom_id }}"> {{ $dsnhom->nhom_ten }} </option>@endforeach</select></td>';
            html += '<td><select name="hh_id[]" class="form-control hh_id" id="hh_id'+count+'" data-sub_hh_id="'+count+'"><option value="" >--Chọn hàng hóa--</option></select></td>';
            html += '<td><input type="text"  name="hh_soluong[]" class="form-control hh_soluong readonly=""  id="hh_soluong'+count+'" value="0" readonly=""></td>';
            html += '<td><input type="text" name="ctdh_soluong[]" class="form-control ctdh_soluong" id="ctdh_soluong'+count+'"  placeholder="nhập số lượng" ></td>';
            html += '<input type="hidden"  name="ctdh_dongia[]" class="form-control ctdh_dongia readonly=""  id="ctdh_dongia'+count+'" value="0" readonly="">';
            html += '<td><input type="text"  name="ctdh_dongia_dinhdang[]" class="form-control ctdh_dongia_dinhdang readonly=""  id="ctdh_dongia_dinhdang'+count+'" value="0" readonly=""></td>';
            html += '<input type="hidden"  name="ctdh_tt[]" class="form-control ctdh_tt"  id="ctdh_tt'+count+'" value="0" readonly="" >';
            html += '<td><input type="text"  name="ctdh_tt_dinhdang[]" class="form-control ctdh_tt_dinhdang"  id="ctdh_tt_dinhdang'+count+'" value="0" readonly="" ></td>';
            if(number > 1){
                html += '<td><button type="button" name="remove" id="" class="btn btn-danger remove">Giảm</button></td></tr>';
                $('tbody').append(html);
                
            }
            else{   
                html += '<td><button type="button" name="add" id="add" class="btn btn-success">Thêm</button></td></tr>';
                $('tbody').html(html);
            }

        }

        $(document).on('click', '#add', function(){
            count++;
            dynamic_field(count);
        });

        $(document).on('click', '.remove', function(){
            count--;
            $(this).closest("tr").remove();
            total_ammount_price();
        });

        $('#dynamic_form').on('submit', function(event){    
            event.preventDefault();
            var a= $(this).serialize();
            console.log(a);
            
            $.ajax({
                url: '{{ route("dynamic-field.insert1") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#taodondathang').attr('disabled','disabled');
                },
                success:function(data){
                    if(data.error){
                        var error_html = '';
                        for(var count = 0; count < data.error.length; count++){
                            error_html += '<p>'+data.error[count]+'</p>';
                        }
                        $('#result').html('<div class="alert alert-danger">'+error_html+'</div>');
                    }
                    else{
                        dynamic_field(1);
                        $('#result').html('<div class="alert alert-success">'+data.success+'</div>');
                        window.location.href="{!!URL::to('banhang/taodondathang')!!}"
                    }
                    $('#taodondathang').attr('disabled', false);
                }
            })
        });

    });

    $('.hh_id').each(function(){
        var count = 1;

        if($(this).val() == ''){
            error += '<p>Chọn hàng hóa tại dòng '+count+' </p>';
            return false;
        }
        count = count + 1;

    });

    $(document).on('change','.nhom_id',function () {
        var nhom_id=$(this).val();
        var sub_nhom_id=$(this).data('sub_nhom_id');
        $.ajax({
            type:'get',
            url:'{!!URL::to('banhang/hanghoa1')!!}',
            //data:{'id':nhom_id,'kho_id':kho_id},
            data:{'id':nhom_id},
      
            success:function(data){
            console.log(data);
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
            url:'{!!URL::to('banhang/dongia1')!!}',
            data:{'id':hh_id},
            dataType:'json',//return data will be json
            success:function(data){
                console.log(data);
                //console.log("hh_dongia");
                //console.log(data.hh_dongia);

                //here price is coloumn name in products table data.coln name
  
                $('#ctdh_dongia'+sub_hh_id).val(data.hh_dongia);
                $('#ctdh_dongia_dinhdang'+sub_hh_id).val(formatNumber(data.hh_dongia, '.', ','));
                $('#ctdh_dongia_dinhdang').prop('disabled', true);

                $('#hh_soluong'+sub_hh_id).val(data.hh_soluong);
                $(document).on('change','.ctdh_soluong',function () {
                    if(parseInt($('#ctdh_soluong'+sub_hh_id).val())>parseInt($('#hh_soluong'+sub_hh_id).val())){
                        alert('Số lượng vượt quá số lượng trong kho');
                        $('#ctdh_soluong'+sub_hh_id).val($('#hh_soluong'+sub_hh_id).val());
                    }
                    else{
                        var ctdh_soluong=$('#ctdh_soluong'+sub_hh_id).val();
                        var ctdh_dongia=$('#ctdh_dongia'+sub_hh_id).val();
                        var ctdh_tt = ctdh_soluong*ctdh_dongia;

                        $('#ctdh_tt'+sub_hh_id).val(ctdh_tt);
                        $('#ctdh_tt_dinhdang'+sub_hh_id).val(formatNumber(ctdh_tt, '.', ','));
                        $('#ctdh_tt_dinhdang').prop('disabled', true);
                        total_ammount_price();
                    }
                }); 
       
                var sl=$('#ctdh_soluong'+sub_hh_id).val();
                var dg=$('#ctdh_dongia'+sub_hh_id).val();
                var t = sl*dg;
                $('#ctdh_tt'+sub_hh_id).val(t);
            },
            error:function(){
            }
        });
    });


    $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url:"{{ route('taodondathang.timsdt_kh') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                    //$('tbody').html(data.table_data);
                    $('#kh_ten').val(data.kh_ten);
                    $('#kh_id').val(data.kh_id);
                    $('#ddh_congnocu').val(data.ddh_congnocu);
                    $('#ddh_congnocu_dinhdang').val(formatNumber(data.ddh_congnocu, '.', ','));
                    $('#ddh_congnocu_dinhdang').prop('disabled', true);
                    
                    //var kh_ten = document.getElementById('kh_ten').value;
                    // var kh_ten=$('#kh_ten').text(data.kh_ten).val();
                    // document.getElementById('kh_ten').value=$('#kh_ten').val(kh_ten);
                  
                    // $('#kh_ten'+kh_ten).val(data.kh_ten);
                    //alert($('#kh_id').text(data.kh_id));
                }
            })
        }

        $(document).on('keyup', '#kh_sdt', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });

    function total_ammount_price() {
        var sum = 0;
        $('.ctdh_tt').each(function(){
            var value = $(this).val();
            if(value.length != 0){
                sum += parseInt(value);
            }
        });
        $('#estimated_ammount').val(sum);
        $('#estimated_ammount_dinhdang').val(formatNumber(sum, '.', ','));
        $('#estimated_ammount_dinhdang').prop('disabled', true);
    }
    // var a = $('#estimated_ammount').val(sum);
    //     $('#estimated_ammount_dinhdang').val(formatNumber(a, '.', ','));
        
    $(document).on('change','#ddh_giamchietkhau',function () {
        tong=$(estimated_ammount).val();
        giamchietkhau=$(this).val();
        tongtiensauchietkhau=tong-(tong*giamchietkhau/100);
        $('#ddh_tongtiensauchietkhau').val(tongtiensauchietkhau);
        $('#ddh_tongtiensauchietkhau_dinhdang').val(formatNumber(tongtiensauchietkhau, '.', ','));
        $('#ddh_tongtiensauchietkhau_dinhdang').prop('disabled', true);
    });

    $(document).on('change','#ddh_datra',function () {
        tong=$(estimated_ammount).val();
        giamchietkhau=$(estimated_ammount).val()*($(ddh_giamchietkhau).val()/100);
        tiendagiam=tong-giamchietkhau;
        congnocu=$('#ddh_congnocu').val();
        khachdatra=$(this).val();
        if(parseInt(khachdatra) > parseInt(tiendagiam)){
            //alert('Số tiền bạn trả lớn hơn tổng tiền');
            $(this).val(khachdatra);
            congnomoihienra = 0;
            $('#ddh_congnomoihienra').val(congnomoihienra);

            thunocu=khachdatra-tiendagiam;
            $('#ddh_thunocu').val(formatNumber(thunocu, '.', ','));

            congnomoi=tiendagiam-khachdatra;
            $('#ddh_congnomoi').val(congnomoi);
            // $('#ddh_congnomoi_dinhdang').val(formatNumber(congnomoi, '.', ','));
            // $('#ddh_congnomoi_dinhdang').prop('disabled', true);

            tongno = parseInt(congnocu) + parseInt(congnomoi);
            $('#ddh_tongno').val(formatNumber(tongno, '.', ','));
        }
        else{
            thunocu = 0;
            $('#ddh_thunocu').val(thunocu);

            $(this).val(khachdatra);
            congnomoi=tiendagiam-khachdatra;
            $('#ddh_congnomoi').val(congnomoi);

            $('#ddh_congnomoihienra').val(formatNumber(congnomoi, '.', ','));
            $('#ddh_congnomoihienra').prop('disabled', true);
            // $('#ddh_congnomoi_dinhdang').val(formatNumber(congnomoi, '.', ','));
            // $('#ddh_congnomoi_dinhdang').prop('disabled', true);

            tongno = parseInt(congnocu) + parseInt(congnomoi);
            $('#ddh_tongno').val(formatNumber(tongno, '.', ','));
        }
        
    });

</script>

<script>
function show(nr) {
    document.getElementById("table1").style.display="none";
    document.getElementById("table2").style.display="none";
    
    document.getElementById("table"+nr).style.display="block";
}

</script>

@endsection