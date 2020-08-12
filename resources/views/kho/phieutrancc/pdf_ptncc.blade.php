<!DOCTYPE html>
<html>
<head>
    <title>PHIẾU TRẢ NHÀ CUNG CẤP-PTNCC00{{$ptncc->ptncc_id}}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        body{
            font-family: DejaVu Sans, sans-serif;
        }
        .table_0, .table_1, .table_2, .tieude{
            border-collapse: collapse;
        }
        .tieude{
            /* border: 1px solid #000; */
            border: none;
            width: 100%;
        }
        /* .tieude td{
            border: 1px solid #000;
        } */
        .phieubanhang{
            font-weight: bold;
            font-size: 30px;
            text-align: center;
            margin-bottom: 5px;
            padding-left: 134px;
        }
        .ma_don{
            text-align: right;
        }
        .table_0{
            width: 100%;
            border: none;
            margin-bottom: 10px;
        }
        .table_1{
            width: 100%;
            margin-top: 5px;
        }
        .table_1 th{
            border: 1px solid #000;
        }
        .table_1 td{
            border: 1px solid #000;
        }
        .table_2{
            border: none;
            width: 310px;
            margin-right: -80px;
        }
        .table_2 th{
            text-align: left;
        }
        .table_2 td{
            text-align: right;
        }
        .table_3{
            border: none;
            width: 100%;
            margin-top: 10px;
        }
        .table_3 th{
            text-align: center;
            /* border: 1px solid #000; */
        }
    </style>
</head>
<body>
        <h1><center>PHIẾU TRẢ NHÀ CUNG CẤP</center></h1>
  <?php 
  $date=date("d-m-Y", strtotime($ptncc->ptncc_ngaylap));
 ?>
  <span><center>Sổ Tiền Mặt Tân Thành -- Ngày:{{ $date }}</center></span> 
    <br>
    <table width=100%>
        <tr>
            <td><i>Nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_ten}}</strong></td>
            <td style="text-align: right;"><i>Địa chỉ nhà cung cấp: </i><strong> {{$ptncc->nhacungcap->ncc_diachi}}</strong></td>
        </tr>
        <tr>
           <td><i>Tạo bởi phiếu nhập: </i><strong>PNK00{{$ptncc->pnk_id}}</strong></td>
        </tr>
    </table>
    
  <br>

  
            <table class="table_1">
                <thead>
                    <tr>
                               <th>STT</th>
                              <th>Tên hàng hóa</th>
                               <th>Đơn vị tính</th>
                              <th>Số lượng</th>
                              <th width="12%">Đơn giá</th>
                              <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
        <?php $i=1;$total=0; ?>
          @foreach($ctncc as $key => $dsctptncc)
          <tr align=center>
            <td>{{$i++}}</td>
            <td>{{$dsctptncc->hh_ten}}</td>
              <td>{{$dsctptncc->hh_donvitinh}}</td>
            <td>{{$dsctptncc->ctncc_soluong}}</td>
            <td>{{number_format($dsctptncc->ctncc_dongia,0,',','.') }}</td>
            <td>{{number_format($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia,0,',','.')}}</td>
            <?php
            $total=$total+($dsctptncc->ctncc_soluong*$dsctptncc->ctncc_dongia);
             ?>
          </tr>
          @endforeach
         <tr>
            <th colspan="5">Tổng tiền</th>
            <th>{{number_format($total,0,',','.') }}</th>
            </tr>
          </tbody>
      </table>
     <hr style="color: black; margin-top: 150px;" />

          <table>
                <thead>
                    <tr>
                        <th width="200px">Người lập phiếu</th>
                        <th width="800px">Nhà cung cấp</th>
                       
                        
                    </tr>
                </thead>
                <tbody>
                </tbody>
            
        </table>      
</body>
</html>