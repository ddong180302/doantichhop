<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chủ</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/themify-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/nice-select.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/frontend/index/css/style.css') }}" type="text/css">
    @toastifyCss
    @toastifyJs
</head>

<body>

    <div style="width:1200px; margin: 0 auto">
        <div style="text-align: center">
            <h2>Xin chào {{ $user->user_name }}</h2>
            <p>Bạn đang muốn mua hàng tại hệ thống của chúng tôi</p>
            <p>Mã xác thực của đơn hàng là</p>
            <p>{{ $user->user_token }}</p>
            <p>Bạn cần nhập mã này để xác thực đơn hàng và tiếp tục mua hàng!</p>
        </div>
    </div>
    <div style="width:1200px; margin: 0 auto">
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
    <script src="{{ asset('public/frontend/index/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery.zoom.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery.dd.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('public/frontend/index/js/main.js') }}"></script>
</body>
