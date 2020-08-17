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
 $date2=date("d-m-Y", strtotime($to_ht));
 ?>
    <div class="row">
        <table border="0" align="center" cellpadding="5" style="border-collapse: collapse;">
           
            <tr>
                <td colspan="11" class="caption" align="center" style="text-align: center; font-size: 20px">
                    <b>BÁO CÁO NHẬP XUẤT TỒN THEO NHÀ CUNG CẤP</b>
                </td>
            </tr>
           <tr>

                <td colspan="11" class="caption" align="center" style="text-align: center; font-size: 15px">
                   Sổ Tiền Mặt Tân Thành 
                </td>
            </tr>
              <tr>
                <td colspan="11" class="caption" align="center" style="text-align: center; font-size: 14px">
                   Từ ngày:{{$date}} - Đến ngày:{{$date2}}
                </td>
            </tr>
             <tr>
                <td colspan="4" class="caption" align="left" style="text-align: center; font-size: 12px">
                <i>Nhà cung cấp: </i><strong>{{$ncc->ncc_ten}}</strong>
                </td>
                <td></td>
                 <td></td>
                 <td></td>
              
                  <td colspan="4" class="caption" align="right" style="text-align: center; font-size: 12px">
            <i>Địa chỉ nhà cung cấp: </i><strong>{{$ncc->ncc_diachi}}</strong>
                </td>
               <tr></tr>
          
              <tr style="border: 1px thin #000;">
                  <th rowspan="2"  style="text-align: center"  align="center" valign="middle" width="12"> Mã hàng hóa</th>
                   <th rowspan="2"  style="text-align: center"  align="center" valign="middle" width="12"> Tên hàng hóa</th> 
                   <th rowspan="2"  style="text-align: center"  align="center" valign="middle" width="10"> Đơn vị</th> 
                    <th colspan="2"  style="text-align: center" align="center" valign="middle" width="22"  > Tồn đầu kỳ</th>
                     <th  colspan="2"  style="text-align: center"  align="center" valign="middle" width="22" > Nhập trong kỳ</th>
                     <th  colspan="2"  style="text-align: center"  align="center" valign="middle" width="22" > Xuất trong kỳ </th>
                    <th  colspan="2"  style="text-align: center"  align="center" valign="middle" width="22" > Tồn cuối kỳ</th>

            </tr>
                 <tr>    
                
                 <th  align="center" valign="middle" width="10">Số lượng</th>
                 <th  align="center" valign="middle" width="12">Đơn giá</th>  
                 <th  align="center" valign="middle" width="10">Số lượng</th>
                 <th  align="center" valign="middle" width="12">Đơn giá</th>  
                 <th  align="center" valign="middle" width="10">Số lượng</th>
                 <th  align="center" valign="middle" width="12">Đơn giá</th>  
                 <th  align="center" valign="middle" width="10">Số lượng</th>
                 <th  align="center" valign="middle" width="12">Đơn giá</th>    
                </tr>
                  @foreach ($data as $key => $value) 
          <?php  $tck=0;?>
               <tr  align=center>
             <td  align="center" valign="middle" width="12">HH00{{$value->hh_id}}</td>
               <td  align="center" valign="middle" width="12">{{$value->hh_ten}}</td>
              <td  align="center" valign="middle" width="10">{{$value->hh_donvitinh}}</td>
              <?php   $data1=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->where('phieunhapkho.pnk_ngaynhapkho','<', $from)->groupBy('hanghoa.hh_id')->get();?>
                @if(!$data1->isEmpty())
                @foreach ($data1 as $key1 => $value1)
                    
                   <td align="center" valign="middle" width="10">{{$value1->quantity}}</td>
                   <td align="center" valign="middle" width="12">{{number_format($value1->total,0,',','.')}}</td>
                     <?php $tck=$tck+$value1->quantity;?>
                   @endforeach
                    @else

                        <td align="center" valign="middle" width="10">0</td>
                        <td align="center" valign="middle" width="12">0</td>
                    @endif
             <?php
              $data2=DB::table('chitietphieunhap')
               ->join('phieunhapkho','phieunhapkho.pnk_id','=','chitietphieunhap.pnk_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitietphieunhap.hh_id')
               ->select(DB::raw('sum(ctpn_soluong) as quantity,sum(ctpn_soluong*ctpn_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieunhapkho.pnk_ngaynhapkho', [$from,$to])->groupBy('hanghoa.hh_id')->get();
                $data3=DB::table('chitiettrancc')
               ->join('phieutrancc','phieutrancc.ptncc_id','=','chitiettrancc.ptncc_id')
               ->join('hanghoa','hanghoa.hh_id','=','chitiettrancc.hh_id')
               ->select(DB::raw('sum(ctncc_soluong) as quantity,sum(ctncc_soluong*ctncc_dongia) as total'))
               ->where('hanghoa.hh_id',$value->hh_id)
               ->whereBetween('phieutrancc.ptncc_ngaylap', [$from,$to])->groupBy('hanghoa.hh_id')->get();
              ?>
               @if(!$data2->isEmpty())
                @foreach ($data2 as $key2 => $value2)
                    
                   <td align="center" valign="middle" width="10">{{$value2->quantity}}</td>
                   <td align="center" valign="middle" width="12">{{number_format($value2->total,0,',','.')}}</td>
                     <?php $tck=$tck+$value2->quantity;?>
                   @endforeach
                    @else

                        <td align="center" valign="middle" width="10">0</td>
                        <td align="center" valign="middle" width="12">0</td>
                    @endif
                     @if(!$data3->isEmpty())
                @foreach ($data3 as $key3 => $value3)
                    
                   <td align="center" valign="middle" width="10">{{$value3->quantity}}</td>
                   <td align="center" valign="middle" width="12">{{number_format($value3->total,0,',','.')}}</td>
                     <?php $tck=$tck-$value3->quantity;?>
                   @endforeach
                    @else

                        <td align="center" valign="middle" width="10">0</td>
                        <td align="center" valign="middle" width="12">0</td>
                    @endif
                    <td align="center" valign="middle" width="10">{{$tck}}</td>
                    <td align="center" valign="middle" width="12">{{number_format($tck*$value->hh_dongia,0,',','.')}}</td></tr>
               @endforeach
                
 </table>

    </div>
</body>


</html>