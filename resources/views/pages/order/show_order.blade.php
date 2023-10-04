<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang mua hàng</title>

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
    <style>
        /* Style for the modal */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }

        /* Style for the modal content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 40px;
            border-radius: 10px;
            width: 50%;
        }

        /* Style for the close button */
        .close {
            padding: 0;
            margin: 0;
            color: #aaaaaa;
            float: right;
            font-size: 38px;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .labeled-input {
            position: relative;
            margin: 20px 0;
        }

        .labeled-input label {
            position: absolute;
            top: -10px;
            left: 10px;
            background-color: #fff;
            padding: 0 5px;
            font-size: 12px;
            color: #999;
        }

        .labeled-input input {
            width: 300px;
            padding: 8px;
            border: 2px solid #ddd;
        }

        .labeled-input select {
            width: 200px;
            padding: 8px;
            border: 2px solid #ddd;
        }
    </style>
</head>

<body>
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                    <div class="mail-service">
                        <i class=" fa fa-envelope"></i>
                        @if (Auth::user())
                            {{ Auth::user()->user_email }}
                        @endif
                    </div>
                    <div class="phone-service">
                        <i class=" fa fa-phone"></i>
                        @if (Auth::user())
                            {{ Auth::user()->user_phone }}
                        @endif
                    </div>
                </div>
                <div class="ht-right">
                    @if (Auth::user())
                        <a href="{{ URL::to('/logout-auth') }}" class="login-panel"><i class="fa fa-user"></i>Đăng
                            xuất</a>
                    @else
                        <a href="{{ URL::to('/login') }}" class="login-panel"><i class="fa fa-user"></i>
                            Đăng nhập
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Trang chủ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <h4 style="color: #e7ab3c; font-size: 26px;font-weight: 600">Địa chỉ nhận hàng</h4>
                    </div>
                </div>
            </div>

            <div class="row" style="align-items: center; line-height: 100%; padding-top: 20px;">
                <div class="col-lg-4">
                    <div style="font-weight: bold; color:black">
                        {{ Auth::user()->user_name }} {{ Auth::user()->user_phone }}
                    </div>
                </div>
                <div class="col-lg-8">
                    <div style="color: black">
                        @if ($wards && $province && $city)
                            {{ $wards->name_xaphuong }}, {{ $province->name_quanhuyen }},
                            {{ $city->name_city }}
                            <a style="color: #e7ab3c; padding-left: 20px; cursor: pointer;" id="changeAddressBtn">Thay
                                đổi</a>
                        @else
                            <a style="color: #e7ab3c; padding-left: 20px; cursor: pointer;" id="changeAddressBtn">Thêm
                                địa chỉ nhận hàng </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- The modal -->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div>
                <span class="close">&times;</span>
            </div>
            <h4>Thay đổi địa chỉ nhận hàng</h4>
            <form id="addressForm" action="{{ URL::to('/update-profile/' . Auth::user()->user_id) }}" method="POST">
                {{ csrf_field() }}
                <div style="display: flex; flex-direction: row; justify-content: space-between">
                    <div class="labeled-input">
                        <label for="inputField">Họ và tên</label>
                        <input type="text" value="{{ Auth::user()->user_name }}" id="inputField" name="user_name">
                    </div>

                    <div class="labeled-input">
                        <label for="inputField">Số điện thoại</label>
                        <input type="text" value="{{ Auth::user()->user_phone }}" id="inputField" name="user_phone">
                    </div>
                </div>

                <div style="display: flex; flex-direction: row; justify-content: space-between">
                    <div class="labeled-input">
                        <label for="inputField">Tỉnh Thành Phố</label>
                        <select name="city" id="city" type="text" class="choose city">
                            @if ($city)
                                <option value="{{ $city->matp }}">{{ $city->name_city }}</option>
                            @else
                                <option value="">--Chọn tỉnh thành phố--</option>
                            @endif
                            @foreach ($city_province as $ci)
                                <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="labeled-input">
                        <label for="inputField">Quận Huyện</label>
                        <select name="province" id="province" type="text" class="choose province">
                            @if ($province)
                                <option value="{{ $province->maqh }}">{{ $province->name_quanhuyen }}</option>
                            @else
                                <option value="">--Chọn quận huyện--</option>
                            @endif
                        </select>
                    </div>
                    <div class="labeled-input">
                        <label for="inputField">Xã Phường</label>
                        <select name="wards" id="wards" type="text" class="wards">
                            @if ($wards)
                                <option value="{{ $wards->xaid }}">{{ $wards->name_xaphuong }}</option>
                            @else
                                <option value="">--Chọn xã phường--</option>
                            @endif
                        </select>
                    </div>
                </div>

                <div style="display: flex; justify-content: right; gap: 20px ">
                    <button class="btn btn-warning">Hủy</button>
                    <input class="btn btn-success" type="submit" value="Lưu thay đổi">
                </div>
            </form>
        </div>
    </div>

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($order)
                                    @foreach ($order as $key => $item)
                                        <tr>
                                            <td class="cart-pic first-row">
                                                <img src="{{ URL::to('public/uploads/product/' . $item->image) }}"
                                                    alt="">
                                            </td>
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
                                @else
                                    <tr>
                                        <td colspan="7"
                                            style="text-align: center; align-items: center; padding-top: 20px">
                                            <div style="text-align: center; display: flex; justify-content: center">
                                                Giỏ hàng trống, bạn cần
                                                thêm
                                                sản phẩm để
                                                tiếp tục mua hàng
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="row breadcrumb-text"
                        style="align-items: center; line-height: 100%; padding: 20px 0;margin-bottom: 20px;">
                        <div class="col-lg-4">
                            <div class="">
                                <h4 style="color: #e7ab3c; font-size: 26px;font-weight: 600">Phương thức thanh toán
                                </h4>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div style="color: black; font-size: 20px">
                                @if ($payment)
                                    {{ $payment->payment_method }}
                                @else
                                    <p>{{ $payment->payment_method }}</p>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 offset-lg-8">
                            <div class="proceed-checkout">
                                <ul>
                                    <li class="subtotal">Số lượng
                                        <span>
                                            {{ number_format($count_product) }}
                                            sản phẩm
                                        </span>
                                    </li>
                                    <li class="cart-total">Tổng tiền
                                        <span>{{ number_format($total_price) }} vnđ</span>
                                    </li>
                                </ul>
                                @if ($wards && $province && $city)
                                    <a href="{{ URL::to('/show-verify-email-order/' . Auth::user()->user_id) }}"
                                        class="proceed-btn">ĐẶT HÀNG</a>
                                @else
                                    <a href="#" id="AddressBtn" class="proceed-btn">ĐẶT HÀNG</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This template is made with <i
                                class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com"
                                target="_blank">Colorlib</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
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
    <script>
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("changeAddressBtn");

        // Get the <span> element that closes the modal
        var closeBtn = document.querySelector(".close");

        var cancelButton = document.querySelector(".btn-warning");

        cancelButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        };

        // When the user clicks on <span> (x), close the modal
        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                event.stopPropagation();
            }
        });
    </script>

    <script>
        // Get the modal element
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("AddressBtn");

        // Get the <span> element that closes the modal
        var closeBtn = document.querySelector(".close");

        var cancelButton = document.querySelector(".btn-warning");

        cancelButton.addEventListener("click", function() {
            modal.style.display = "none";
        });

        // When the user clicks the button, open the modal
        btn.onclick = function() {
            modal.style.display = "block";
        };

        // When the user clicks on <span> (x), close the modal
        closeBtn.addEventListener("click", function() {
            modal.style.display = "none";
        });

        modal.addEventListener("click", function(event) {
            if (event.target === modal) {
                event.stopPropagation();
            }
        });
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            //fetch_delivery();
            $('.choose').on('change', function() {
                var action = $(this).attr('id');
                var ma_id = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: '{{ url('/select-delivery') }}',
                    method: 'POST',
                    data: {
                        action: action,
                        ma_id: ma_id,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    }
                });
            });
        })
    </script>
</body>

</html>
