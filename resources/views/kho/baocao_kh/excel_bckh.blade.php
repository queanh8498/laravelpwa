<!DOCTYPE html>
<html>
<head>
    <title>BÁO CÁO </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
 
   <body style="font-size: 10px">
    <?php 

  $date=date("d-m-Y", strtotime($from));
  $date1=date("d-m-Y", strtotime($to));
 ?>
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
           
            <tr>
                <td colspan="7" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>BÁO CÁO NHẬP XUẤT THEO KHÁCH HÀNG</b>
                </td>
            </tr>
           <tr>

                <td colspan="7" class="caption" align="center" style="text-align: center; font-size: 15px">
                   Sổ Tiền Mặt Tân Thành 
                </td>
            </tr>
              <tr>
                <td colspan="7" class="caption" align="center" style="text-align: center; font-size: 14px">
                   Từ ngày:{{$date}} - Đến ngày:{{$date1}}
                </td>
            </tr>
             <tr>
                <td colspan="2" class="caption" align="left" style="text-align: center; font-size: 12px">
               <i>Khách hàng: </i><strong>{{$kh->kh_ten}}</strong>
                </td>
                <td></td>
                 <td></td>
               
                  <td colspan="2" class="caption" align="right" style="text-align: center; font-size: 12px">
            <i>Địa chỉ: </i><strong>{{$kh->kh_diachi}}</strong>
                </td>
               <tr></tr>
          
              <tr style="border: 1px thin #000;">
                  <th style="text-align: center" align="center" valign="middle" width="12"> Mã hàng hóa</th>
                  <th style="text-align: center" align="center" valign="middle" width="15"> Tên hàng hóa</th> 
                  <th style="text-align: center" align="center" valign="middle" width="15"> Đơn vị</th> 
                  <th style="text-align: center" align="center" valign="middle" width="25">Số lượng hàng khách mua</th>
                  <th style="text-align: center" align="center" valign="middle" width="25" > Số lượng hàng khách trả </th>
                  <th style="text-align: center" align="center" valign="middle" width="25"> Tổng</th>
               

            </tr>
              
                 @foreach ($data as $key => $value) 
          <?php  $tck=0;?>
               <tr  align=center>
             <td align="center" valign="middle" width="12">HH00{{$value->hh_id}}</td>
               <td align="center" valign="middle" width="15">{{$value->hh_ten}}</td>
              <td align="center" valign="middle" width="15">{{$value->hh_donvitinh}}</td>
             
             <?php
             $data2=DB::table('chitiettrahang')
               ->join('phieutrahang','phieutrahang.pth_id','=','chitiettrahang.pth_id')
              ->join('dondathang','phieutrahang.ddh_id','=','dondathang.ddh_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrahang.hh_id')
               ->select(DB::raw('sum(ctth_soluong) as quantity,sum(ctth_soluong*ctth_dongia) as total'))
                ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$kh->kh_id]])
               ->whereBetween('phieutrahang.pth_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitietdathang')
                  ->join('hanghoa','hanghoa.hh_id','=','chitietdathang.hh_id')
                  ->join('dondathang','dondathang.ddh_id','=','chitietdathang.ddh_id')
               ->select(DB::raw('sum(ctdh_soluong) as quantity,sum(ctdh_soluong*ctdh_dongia) as total'))
               ->where([['hanghoa.hh_id',$value->hh_id],['dondathang.kh_id',$kh->kh_id]])
               ->whereBetween('dondathang.ddh_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
              ?>
                 @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td align="center" valign="middle" width="25">{{$value3->quantity}}</td>
              
                     <?php $tck=$tck+$value3->quantity;?>
                   @endforeach
                    @else

                      
                        <td align="center" valign="middle" width="25">0</td>
                    @endif
               @if(!$data2->isEmpty())
                @foreach ($data2 as $key2 => $value2)
                    
                   <td align="center" valign="middle" width="25">{{$value2->quantity}}</td>
                
                     <?php $tck=$tck-$value2->quantity;?>
                   @endforeach
                    @else

                     
                        <td align="center" valign="middle" width="25">0</td>
                    @endif
                  
                    <td align="center" valign="middle" width="25">{{$tck}}</td>
                  
               @endforeach
                
 </table>

    </div>
</body>


</html>