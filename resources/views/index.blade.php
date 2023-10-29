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

    <style>
        #pagination-container nav {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 20px;
        }

        #pagination-container nav .hidden {
            display: none;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        #pagination-container nav .hidden .relative {
            font-size: 14px !important;
        }

        #pagination-container nav .hidden .relative a {
            font-size: 14px !important;
        }

        #pagination-container nav .hidden .relative a svg {
            font-size: 14px !important;
            width: 20px !important;
        }

        #pagination-container svg {
            width: 20px !important;
        }

        .filter-container {
            margin-bottom: 20px;
        }

        #priceRangeSlider {
            width: 300px;
            margin-bottom: 10px;
        }

        .price-value {
            display: inline-block;
            margin-left: 10px;
        }

        .filter-button {
            margin-left: 10px;
        }

        .item-list {
            list-style-type: none;
            padding: 0;
        }

        .item {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
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
                        <a href="{{ URL::to('/logout-auth') }}" class="login-panel">
                            <img style="width: 21px; border-radius: 50%; margin: 10px"
                                src="{{ asset('public/uploads/user/' . Auth::user()->user_avatar) }}" alt="">
                            Đăng xuất
                        </a>
                    @else
                        <a href="{{ URL::to('/login') }}" class="login-panel">
                            <i class="fa fa-user"></i>
                            Đăng nhập
                        </a>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-2 col-md-2">
                        <div class="logo">
                            <a href="#">
                                <img src="" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7">
                        <div class="advanced-search">
                            <a href="{{ URL::to('/') }}"><button type="button" class="category-btn">
                                    Tất cả sản phẩm</button></a>
                            <form action={{ URL::to('/tim-kiem') }} method="POST" class="input-group">
                                {{ csrf_field() }}
                                <input type="text" name="keywords_submit" placeholder="Bạn cần tìm sản phẩm nào?">
                                <button type="submit" name="search_items"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        <ul class="nav-right">
                            <li class="cart-icon">
                                @if (Auth::user())
                                    <a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}">
                                        <i class="icon_bag_alt"></i>
                                        @if ($count_product)
                                            <span id="total-quantity-show">
                                                {{ $count_product }}
                                            </span>
                                        @else
                                            <span id="total-quantity-show">0</span>
                                        @endif
                                    </a>
                                @else
                                    <a href="{{ URL::to('/login') }}">
                                        <i class="icon_bag_alt"></i>
                                    </a>
                                @endif
                                @if (Auth::user() && $cart && $count_product > 0)
                                    <div class="cart-hover">
                                        <div id="change-item-cart">
                                            <div class="select-items">
                                                <table>
                                                    <tbody>
                                                        @foreach ($cart as $key => $item)
                                                            <tr>
                                                                <td class="si-pic"><img
                                                                        src="{{ URL::to('public/uploads/product/' . $item->product_image) }}"
                                                                        alt=""></td>
                                                                <td class="si-text">
                                                                    <div class="product-selected">
                                                                        <p>{{ number_format($item->product_price) }}
                                                                            đ x {{ $item->quantity }}
                                                                        </p>
                                                                        <h6>{{ $item->product_name }}
                                                                        </h6>
                                                                    </div>
                                                                </td>
                                                                <td class="si-close">
                                                                    <a
                                                                        href="{{ URL::to('/delete-item-cart/' . $item->product_id . '/' . Auth::user()->user_id) . '/' . $item->cart_id . '/' . $item->cart_detail_id }}">
                                                                        <i class="ti-close"></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="select-total">
                                                <span>total:</span>
                                                <h5>{{ number_format($total_price) }} vnđ</h5>
                                            </div>
                                        </div>
                                        <div class="select-button">
                                            <a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}"
                                                class="primary-btn view-card">
                                                XEM GIỎ HÀNG
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="cart-hover">
                                        <div style="align-item: center; text-align: center">
                                            GIỎ HÀNG TRỐNG
                                        </div>
                                    </div>
                                @endif
                            </li>
                        </ul>
                    </div>
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
                        @if (Auth::user())
                            <li>
                                <a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}">Giỏ hàng</a>
                            </li>
                        @endif
                        @if (Auth::user())
                            @if (Auth::user() && Auth::user()->user_role === 'QUANTRIVIEN')
                                <li>
                                    <a href="{{ URL::to('/dashboard') }}">Trang quản trị</a>
                                </li>
                            @endif
                        @endif
                        @if (Auth::user())
                            <li>
                                <a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}">
                                    Trang cá nhân
                                </a>
                            </li>
                        @endif
                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
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
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">
                    <div class="product-list">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var inputElement = document.getElementById('inputQuantity');
        if (inputElement) {
            inputElement.addEventListener('input', function() {
                var regex = /^[0-9]+$/;
                var isValid = regex.test(input.value);
                if (!isValid) {
                    toastify().warning(`Vui lòng chỉ nhập số.`);
                    input.value = "";
                }
                var inputValue = parseInt(inputElement.value);
                var max = parseInt(inputElement.getAttribute('max'));

                if (inputValue > max) {
                    inputElement.value = max; // Đặt giá trị thành giá trị max nếu vượt quá
                    toastify().warning(`Số lượng vượt quá ${max}`);
                }

                if (inputValue < 1) {
                    inputValue = inputValue; // Đặt giá trị thành giá trị max nếu vượt quá
                    toastify().warning(`Số lượng không được nhỏ hơn 1`);
                }
            });
        }
    </script>
    <script>
        function AddCart(product_id, user_id) {
            $.ajax({
                url: 'add-cart/' + product_id + user_id,
                type: 'GET',
            }).done(function(response) {
                RenderCart(response);
                toastify().success('Thêm sản phẩm thành công');
            });
        }
        $("#change-item-cart").on("click", ".si-close i", function() {
            $.ajax({
                url: 'delete-item-cart/' + $(this).data("id"),
                type: 'GET',
            }).done(function(response) {
                RenderCart(response);
                toastify().success('Đã xóa sản phẩm thành công');
            });
        })

        function SaveItemDetailCart(id) {
            $.ajax({
                url: 'save-item-detail-cart/' + id + '/' + $("#quantity-item-" + id).val(),
                type: 'GET',

            }).done(function(response) {
                RenderCart(response);
                toastify().success('Đã lưu số lượng sản phẩm thành công');
            });
        }

        function RenderCart(response) {
            $("#change-item-cart").empty();
            $("#change-item-cart").html(response);
            $("#total-quantity-show").text($("#total-quantity-cart").val());
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#filter-option').on('change', function() {
                var url = $(this).val();
                if (url) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('#product-list').html(data);
                        },
                        error: function() {
                            alert('Đã xảy ra lỗi. Vui lòng thử lại sau.');
                        }
                    });
                }
                return false;
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            // Lấy các phần tử và giá trị ban đầu
            var priceRangeSlider = $('#priceRangeSlider');
            var minPriceValue = $('#minPriceValue');
            var maxPriceValue = $('#maxPriceValue');
            var productList = $('#product-list');

            // Thiết lập thanh trượt có thể trượt 2 đầu
            priceRangeSlider.slider({
                range: true,
                min: 0,
                max: 100000000,
                step: 1000000,
                values: [0, 100000000],
                slide: function(event, ui) {
                    var minPrice = ui.values[0];
                    var maxPrice = ui.values[1];

                    // Định dạng giá trị thành tiền tệ Việt Nam đồng
                    var minPriceFormatted = minPrice.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });
                    var maxPriceFormatted = maxPrice.toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    });

                    minPriceValue.text(minPriceFormatted);
                    maxPriceValue.text(maxPriceFormatted);
                }
            });

            // Hiển thị giá trị ban đầu trên thanh trượt
            var initialMinPrice = priceRangeSlider.slider('values', 0);
            var initialMaxPrice = priceRangeSlider.slider('values', 1);

            // Định dạng giá trị ban đầu thành tiền tệ Việt Nam đồng
            var initialMinPriceFormatted = initialMinPrice.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });
            var initialMaxPriceFormatted = initialMaxPrice.toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            });

            minPriceValue.text(initialMinPriceFormatted);
            maxPriceValue.text(initialMaxPriceFormatted);

            // Lọc danh sách khi nút "Lọc" được click
            $('#filterButton').click(function() {
                var minPrice = priceRangeSlider.slider('values', 0);
                var maxPrice = priceRangeSlider.slider('values', 1);

                // Định dạng giá trị Việt Nam đồng
                var minPriceFormatted = minPrice.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });
                var maxPriceFormatted = maxPrice.toLocaleString('vi-VN', {
                    style: 'currency',
                    currency: 'VND'
                });

                // Hiển thị giá trị đã định dạng
                minPriceValue.text(minPriceFormatted);
                maxPriceValue.text(maxPriceFormatted);

                // Ẩn hoặc hiển thị các mục dựa trên khoảng giá
                productList.find('.product-item-price').each(function() {
                    var itemPrice = parseInt($(this).data('price'));
                    if (itemPrice >= minPrice && itemPrice <= maxPrice) {
                        $(this).show();
                    } else {
                        $(this).hide();
                    }
                });
            });
        });
    </script>
</body>

</html>
