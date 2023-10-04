<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang giỏ hàng</title>

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
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>Danh mục</span>
                        <ul class="depart-hover">
                            @foreach ($category as $key => $cate)
                                <li>
                                    <a
                                        href="{{ URL::to('/danh-muc-san-pham/' . $cate->category_id) }}">{{ $cate->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                        <li><a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}">Giỏ hàng</a></li>
                        @if (Auth::user())
                            @if (Auth::user() && Auth::user()->user_role === 'QUANTRIVIEN')
                                <li><a href="{{ URL::to('/dashboard') }}">Trang quản trị</a></li>
                            @endif
                        @endif
                        @if (Auth::user())
                            <li><a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}">Trang cá
                                    nhân</a></li>
                        @endif
                        <li><a href="#">Contact</a></li>
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="{{ URL::to('/') }}"><i class="fa fa-home"></i> Home</a>
                        <span>Shopping Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12" id="list-cart">
                    <div class="cart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th class="p-name">Tên sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng tiền</th>
                                    <th>Câp nhật</th>
                                    <th>Xóa</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($cart && $count_product > 0)
                                    @foreach ($cart as $key => $item)
                                        <tr>
                                            <td class="cart-pic first-row">
                                                <img src="{{ URL::to('public/uploads/product/' . $item->product_image) }}"
                                                    alt="">
                                            </td>
                                            <td class="cart-title first-row">
                                                <h5>{{ $item->product_name }}</h5>
                                            </td>
                                            <td class="p-price first-row">
                                                {{ number_format($item->product_price) }} đ
                                            </td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <input class="quantityProductCart"
                                                        id="inputQuantity_{{ $item->cart_detail_id }}"
                                                        style="width: 70px; outline: none; border: 2px solid #333; padding: 5px; text-align: center; border-radius: 5px; color: black; font-size: 16px"
                                                        type="number" value="{{ $item->quantity }}" min="1"
                                                        max="{{ $item->product_quantity }}">
                                                </div>
                                            </td>
                                            <td class="total-price first-row">
                                                {{ number_format($item->product_price * $item->quantity) }}
                                            </td>
                                            <td class="close-td first-row">
                                                <a id="updateCartLink_{{ $item->cart_detail_id }}" href="#"
                                                    onclick="updateCartDetail({{ $item->cart_detail_id }})">
                                                    <i class="ti-save"></i>
                                                </a>
                                            </td>
                                            <td class="close-td first-row">
                                                <a
                                                    href="{{ URL::to('/delete-item-cart/' . $item->product_id . '/' . Auth::user()->user_id) . '/' . $item->cart_id . '/' . $item->cart_detail_id }}">
                                                    <i class="ti-close"></i>
                                                </a>

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
                                                tiếp tục mua hàng</div>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    @if ($cart && $count_product > 0)
                        <div class="row">
                            <div class="col-lg-4 offset-lg-8">
                                <div class="proceed-checkout">
                                    <ul>
                                        <li class="subtotal">Số lượng
                                            <span>{{ number_format($count_product) }}
                                                sản phẩm</span>
                                        </li>
                                        <li class="cart-total">Tổng tiền
                                            <span>{{ number_format($total_price) }} vnđ</span>
                                        </li>
                                    </ul>
                                    <a href="{{ URL::to('/show-order/' . Auth::user()->user_id) }}"
                                        class="proceed-btn">THANH TOÁN</a>
                                </div>
                            </div>
                        </div>
                    @else
                        <div></div>
                    @endif
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
                            Được thực hiện bởi nhóm 2 vào năm
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
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
        function updateCartDetail(cartDetailId) {
            var quantity = document.getElementById('inputQuantity_' + cartDetailId).value;
            var updateUrl = "{{ URL::to('/update-cart-detail') }}/" + cartDetailId + "/" + quantity;
            window.location.href = updateUrl;
        }
    </script>
    <script>
        var inputElements = document.getElementsByClassName("quantityProductCart");

        for (var i = 0; i < inputElements.length; i++) {
            var inputElement = inputElements[i];

            inputElement.addEventListener('input', function() {
                var inputValue = parseInt(this.value);
                var max = parseInt(this.getAttribute('max'));

                if (inputValue > max) {
                    this.value = max; // Đặt giá trị thành giá trị max nếu vượt quá
                    toastify().warning(`Số lượng vượt quá ${max}`);
                }
            });
        }
    </script>
    <script>
        function DeleteListItemCart(id) {
            $.ajax({
                url: 'delete-item-list-cart/' + id,
                type: 'GET',

            }).done(function(response) {
                RenderListCart(response);
                toastify().success('Đã xóa sản phẩm thành công');
            });
        }

        function SaveListItemCart(id) {
            $.ajax({
                url: 'save-item-list-cart/' + id + '/' + $("#quantity-item-" + id).val(),
                type: 'GET',

            }).done(function(response) {
                RenderListCart(response);
                toastify().success('Đã lưu số lượng sản phẩm thành công');
            });
        }

        function RenderListCart(response) {
            $("#list-cart").empty();
            $("#list-cart").html(response);

            var proQty = $('.pro-qty');
            proQty.prepend('<span class="dec qtybtn">-</span>');
            proQty.append('<span class="inc qtybtn">+</span>');
            proQty.on('click', '.qtybtn', function() {
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 1) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 1;
                    }
                }
                $button.parent().find('input').val(newVal);
            });

        }
    </script>
</body>

</html>
