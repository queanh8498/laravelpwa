@extends('admin_banhang')
@section('admin_content')
     <a  type="button" name="taonhom" class="btn btn-info" href="{{URL::to('banhang/tao-nhom')}}"> <i class="glyphicon glyphicon-plus"></i>Tạo nhóm hàng hóa</a>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Danh sách nhóm hàng hóa
    </div>
  
                         @if(session('thongbao'))
                            <span class="text-alert">
                                {{session('thongbao')}}
                            </span>
                        @endif
    <div class="table-responsive">
      <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="ncc_id" class="form-control input-sm m-bot15" id="ncc_id">
                                        <option value="0">--Chọn nhà cung cấp--</option>
                                        @foreach($ncc as $key => $dsncc)
                                            <option value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                        @endforeach
                                            
                                    </select>
                                </div>
  
<table class="table table-striped b-t b-light" id="dataTables-example">
      
            <?php echo $output; ?>
       
      </table>
    </div>
    
  </div>
</div>
<script type="text/javascript">
  $(document).on('change','#ncc_id',function () {
      var ncc_id=$(this).val();
        $.get("banhang/nhomhanghoa/"+ncc_id,function(data){
          console.log(data);
        $("#dataTables-example").html(data);
    });
    });
</script>
@endsection