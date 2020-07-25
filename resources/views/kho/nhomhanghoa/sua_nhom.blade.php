@extends('admin_banhang')
@section('admin_content')
<div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                           Sửa thông tin nhóm hàng hóa
                        </header>
                         @if(count($errors)>0)
                        <span class="text-alert">
                            @foreach($errors->all() as $err)
                                {{$err}}<br>
                                @endforeach
                            </span>
                         @endif
                        
                        <div class="panel-body">

                            <div class="position-center">
                                <form role="form" action="{{URL::to('/banhang/sua-nhom/'.$nhom->nhom_id)}}" method="post">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                    <label for="exampleInputPassword1">Nhà cung cấp</label>
                                      <select name="ncc_id" class="form-control input-sm m-bot15">
                                        @foreach($ncc as $key => $dsncc)
                                            @if($dsncc->ncc_id==$nhom->ncc_id)
                                            <option selected value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                            @else
                                            <option value="{{$dsncc->ncc_id}}">{{$dsncc->ncc_ten}}</option>
                                            @endif
                                        @endforeach
                                            
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên nhóm</label>
                                    <input type="text" name="nhom_ten" class="form-control" id="exampleInputEmail1" value="{{$nhom->nhom_ten}}" placeholder="Tên nhà cung cấp">
                                </div>
                              
                          
                                 <button type="submit" name="suanhom" class="btn btn-info">Lưu</button>
                         
                               
                               
                                </form>
                         

                        </div>
                    </div>
                    </section>

            </div>
        </div>
@endsection