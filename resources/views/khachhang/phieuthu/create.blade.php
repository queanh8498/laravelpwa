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
        <div class="col-lg-1">
        </div>
        <div class="col-lg-10">
            <section class="panel">
                <header class="panel-heading">
                    LẬP PHIẾU THU
                </header>
                
                <div class="panel-body">
				   
                    <form id="dynamic_form" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="kh_sdt">SDT:</label>
                                    <input type="text" name="kh_sdt" class="form-control" id="kh_sdt" >             
                                </div>
                                <div class="col-md-4">
                                    <label for="kh_ten">Khách hàng:</label>
                                    <input type="text" name="kh_ten" class="form-control" id="kh_ten" readonly > 
                                </div>
                                <div>
                                    <input type="hidden" name="kh_id" class="form-control" id="kh_id" >
                                </div>
                                <div class="col-md-5">
                                    <label for="congnocu_dinhdang">Tổng công nợ</label>
                                    <input type="text" name="congnocu_dinhdang" class="form-control" id="congnocu_dinhdang" readonly>
                                </div>
                                <div>
                                    <input type="hidden" name="congnocu" class="form-control" id="congnocu" readonly>
                                </div>
                            </div>         
                        </div>
                      
                        <div class="form-group">
                            <div class="row">
                              
                                <div class="col-md-7">
                                    <label for="pt_tienthu">Thu từ khách: </label>
                                    <input type="text" name="pt_tienthu" class="form-control" id="pt_tienthu">
                                </div>
                               
                                <div>
                                    <input type="hidden" name="no_hientai" class="form-control" id="no_hientai" readonly>
                                </div>
                               
                                <div class="col-md-5">
                                    <label for="no_hientaihienra">Còn nợ</label>
                                    <input type="text" name="no_hientaihienra" class="form-control" id="no_hientaihienra">
                                </div>
                            </div>
                        </div>
                        @csrf
                        <span id="result"></span>
                        <button type="submit" name="phieuthu" class="btn btn-info">Lưu và tiếp tục tạo mới</button>
                        <a type="button" name="phieuthu" class="btn btn-success" href="{{ URL::to('banhang/phieuthu') }}">Trở về</a><br>
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
           

        }

        $('#dynamic_form').on('submit', function(event){    
            event.preventDefault();
            var a= $(this).serialize();
            console.log(a);
            
            $.ajax({
                url: '{{ route("dynamic-field.store") }}',
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                beforeSend:function(){
                    $('#phieuthu').attr('disabled','disabled');
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
                        window.location.href="{!!URL::to('banhang/phieuthu')!!}"
                    }
                    $('#phieuthu').attr('disabled', false);
                }
            })
        });

    });

    $(document).ready(function(){
        fetch_customer_data();
        function fetch_customer_data(query = ''){
            $.ajax({
                url:"{{ route('phieuthu.timsdt_kh') }}",
                method:'GET',
                data:{query:query},
                dataType:'json',
                success:function(data){
                    $('#kh_ten').val(data.kh_ten);
                    $('#kh_id').val(data.kh_id);
                    $('#congnocu').val(data.congnocu);
                    $('#congnocu_dinhdang').val(formatNumber(data.congnocu, '.', ','));
                    $('#congnocu_dinhdang').prop('disabled', true);
                    
                }
            })
        }

        $(document).on('keyup', '#kh_sdt', function(){
            var query = $(this).val();
            fetch_customer_data(query);
        });
    });

    $(document).on('change','#pt_tienthu',function () {
      
        congnocu=$('#congnocu').val(); //là tổng nợ hiện tại đó
        khachdatra=$(this).val();

        if(parseInt(khachdatra) > parseInt(congnocu)){
            alert('Số tiền thu vượt quá tổng nợ');
            $(this).val(congnocu);
            congnomoihienra = 0;
            $('#no_hientaihienra').val(congnomoihienra);
            $('#no_hientai').val(congnomoi);
            
        }
        else{
            
            $(this).val(khachdatra);
            congnomoi=congnocu-khachdatra;
            $('#no_hientai').val(congnomoi);

            $('#no_hientaihienra').val(formatNumber(congnomoi, '.', ','));
            $('#no_hientaihienra').prop('disabled', true);
            
        }
        
    });

</script>


@endsection