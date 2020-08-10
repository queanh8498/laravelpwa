@extends('admin_banhang')
@section('admin_content')
<style>
  .button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
}
.button1 {background-color: #4CAF50;} /* Green */
.button2 {background-color: #008CBA; width: 65%;} /* Blue */
.button3 {background-color: #f44336;} /* Red */
  </style>
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
    Danh sách hàng hóa tồn kho
    </div>
   
    <div class="table-responsive">
                      <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                            ?>
                              <div class=" col-md-4 form-group">
                                      <select name="tinhtrang" class="form-control input-sm m-bot15" id="tinhtrang">
                                        <option value="0">--------Chọn tình trạng hàng hóa--------</option>
                                     
                                            <option value="1">Còn hàng</option>
                                             <option value="2">Sắp hết hàng</option>
                                              <option value="3">Hết hàng</option>
                                     
                                            
                                    </select>
                                </div>
      <table class= "table table-bordered table-striped" id="dataTables-example">
      
      <?php echo $output; ?>
        
      </table>
    </div>
   
  </div>
</div>
<script type="text/javascript">
  $(document).on('change','#tinhtrang',function () {
      var tinhtrang=$(this).val();
    
        $.get("banhang/tinhtrang/"+tinhtrang,function(data){
  
        $("#dataTables-example").html(data);
    });
    });
</script>
@endsection