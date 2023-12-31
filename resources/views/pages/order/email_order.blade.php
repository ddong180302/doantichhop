<div style="width:1200px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $user->user_name }}</h2>
        <p>Bạn đang muốn mua hàng tại hệ thống của chúng tôi</p>
        <p>Mã xác thực của đơn hàng là</p>
        <p>{{ $user->user_token }}</p>
        <p>Bạn cần nhập mã này để xác thực đơn hàng và tiếp tục mua hàng!</p>
    </div>
    <div style="text-align: center">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @if ($cart_detail)
                    @foreach ($cart_detail as $key => $item)
                        <tr>
                            <td class="first-row">
                                <h5>{{ $item->name }}</h5>
                            </td>
                            <td class="p-price first-row">
                                {{ number_format($item->price) }} đ
                            </td>
                            <td class="qua-col first-row">
                                {{ $item->quantity }}
                            </td>
                            <td class="total-price first-row">
                                {{ number_format($item->price * $item->quantity) }}
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
    <div>
        <div>Địa chỉ nhận hàng</div>
        <div>{{ $wards->name_xaphuong }}, {{ $province->name_quanhuyen }},
            {{ $city->name_city }}</div>
        <div>Tổng tiền đơn hàng</div>
        <div>{{ number_format($total_price) }} đ</div>
    </div>
</div>
