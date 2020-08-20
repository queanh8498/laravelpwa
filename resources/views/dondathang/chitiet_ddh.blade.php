@extends('admin_banhang')

@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đơn hàng
            </div>
           
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                @foreach ($ddh as $ddh)
                    <tr>
                        <th>Mã hóa đơn:</th>
                        <td>{{ $ddh->ddh_id }}</td>
                        <th>Trạng thái:</th>
                        <td>
                            @if(($ddh->ddh_trangthai)==2)
                                {{ 'Có trả hàng' }}
                            @else
                                {{ 'Đã giao hàng' }}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Ngày lập:</th>
                        <td>{{ $ddh->ddh_ngaylap }}</td>
                        <th>Nhân viên bán:</th>
                        <td>{{ $ddh->name }}</td>
                    </tr>
                    <tr>
                        <th>Khách hàng:</th>
                        <td>{{ $ddh->kh_ten }}</td>
                        <th>SĐT:</th>
                        <td>{{ $ddh->kh_sdt }}</td>
                    </tr>
                    <tr>
                        <th>Công nợ cũ:</th>
                        <td>{{ number_format($ddh->ddh_congnocu, 0, ',' , ',') }} VND</td>
                        <th>Ngày cho nợ:</th>
                        <td>{{ $ddh->bccn_hanno }}</td>
                    </tr>
                @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="table-agile-info">
        <div class="table-responsive">
            <table class="table table-striped b-t b-light">
                <thead>
                    <tr>
                        <th>Mã hàng hóa</th>
                        <th>Tên hàng hóa</th>
                        <th>Số lượng</th>
                        <th>Giá sản phẩm</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ddh1 as $ddh1)
                    <tr>
                    
                        <td>{{ $ddh1->hh_id }}</td>
                        <td>{{ $ddh1->hh_ten }}</td>
                        <td>{{ $ddh1->ctdh_soluong }}</td>
                        <td>{{ number_format($ddh1->ctdh_dongia, 0, ',' , ',') }} VND</td>
                        <td>{{ number_format($ddh1->TongTien, 0, ',' , ',') }} VND</td>
                        
                    </tr>
                    @endforeach
                </tbody>

                <table align="right" width="400" height="200" style="color: #999; font-size: 14.4px; padding: 50px;">
                    @foreach ($ddh2 as $ddh2)
                    <tr>
                        <th>
                            Tổng số lượng: 
                        </th>
                        <td>
                            {{ $ddh2->TongSoLuong }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tổng tiền hàng: 
                        </th>
                        <td>
                            {{ number_format($ddh2->TongTienHang, 0, ',' , ',') }} VND
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Giảm chiết khấu: 
                        </th>
                        <td>
                            {{ $ddh2->ddh_giamchietkhau }}%
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tổng cộng: 
                        </th>
                        <td>
                            {{ number_format($ddh2->TongCong, 0, ',' , ',') }} VND
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Khách đã trả: 
                        </th>
                        <td>
                            {{ number_format($ddh2->ddh_datra, 0, ',' , ',') }} VND
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Nợ hiện tại:
                        </th>
                        <td>
                            {{ number_format($ddh2->TongCong-$ddh2->ddh_datra, 0, ',' , ',') }} VND
                        </td>
                    </tr>
                    <tr>
                        <th>
                            Tổng nợ:  
                        </th>
                        <td>
                            {{ number_format($ddh2->ConLai, 0, ',' , ',') }} VND
                        </td>
                    </tr>
                    @endforeach
            </table>
        </div>
    </div>

@endsection