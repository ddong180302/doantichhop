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
        .profile-layout {
            height: 600px;
            background: #fbf6f6;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 40px;
            border-radius: 5px;
        }

        .profile-layout .profile-avatar {
            display: flex;
            justify-content: space-between;
            border-right: 1px solid #333;
            flex-direction: column;
            height: 100%;
        }

        .profile-layout .profile-avatar .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 20px 0;
            display: flex;
            justify-content: center;
            height: 20%;
        }

        .profile-layout .profile-avatar .avatar {
            overflow: hidden;
            height: 60%;
            align-items: center;
            text-align: center;
        }

        .profile-layout .profile-avatar .avatar img {
            width: 300px;
            height: 300px;
            border-radius: 50%;
        }

        .profile-layout .profile-avatar .avatar-action {
            height: 20%;
            padding-top: 20px;
            text-align: center;
        }

        .profile-layout .profile-avatar .avatar-action .action {
            display: flex;
            flex-direction: row;
            justify-content: center;
        }

        .profile-layout .profile-info .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 20px 0;
            display: flex;
            justify-content: center
        }

        .profile-layout .profile-info .info-title {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            padding: 10px 0;
        }

        .profile-layout .profile-info .info-action {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            margin: 30px 0;
        }

        .profile-layout .profile-info .info-action .title-info {
            width: 40%
        }

        .profile-layout .profile-info .info-action .info-name {
            width: 60%
        }

        .profile-layout .profile-info .info-title .title-info {
            width: 40%
        }

        .profile-layout .profile-info .info-title .title-info .label {
            font-family: sans-serif;
            font-size: 20px
        }

        .profile-layout .profile-info .info-title .info-name {
            width: 60%
        }

        .profile-layout .profile-info .info-title .info-name .input {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            width: 100%;
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
                            <i class="fa fa-user"></i>
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
        <div class="nav-item">
            <div class="container">
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li><a href="{{ URL::to('/') }}">Trang chủ</a></li>
                        <li><a href="{{ URL::to('/show-cart') }}">Giỏ hàng</a></li>
                        @if (Auth::user())
                            @if (Auth::user() && Auth::user()->user_role === 'QUANTRIVIEN')
                                <li><a href="{{ URL::to('/dashboard') }}">Trang quản trị</a></li>
                            @endif
                        @endif
                        @if (Auth::user())
                            <li>
                                <a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}">
                                    Lịch sử mua hàng
                                </a>
                            </li>
                        @endif
                        <li><a href="#">Đổi mật khẩu</a></li>
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
            @yield('user')
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a href="#"><img src="img/footer-logo.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Address: Duy Tân - Đà Nẵng</li>
                            <li>Phone: +84 932562365</li>
                            <li>Email: trandangdong1803@gmail.com</li>
                        </ul>
                        <div class="footer-social">
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-instagram"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 offset-lg-1">
                    <div class="footer-widget">
                        <h5>Information</h5>
                        <ul>
                            <li><a href="#">About Us</a></li>
                            <li><a href="#">Checkout</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Serivius</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="footer-widget">
                        <h5>My Account</h5>
                        <ul>
                            <li><a href="#">My Account</a></li>
                            <li><a href="#">Contact</a></li>
                            <li><a href="#">Shopping Cart</a></li>
                            <li><a href="#">Shop</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="newslatter-item">
                        <h5>Join Our Newsletter Now</h5>
                        <p>Get E-mail updates about our latest shop and special offers.</p>
                        <form action="#" class="subscribe-form">
                            <input type="text" placeholder="Enter Your Mail">
                            <button type="button">Subscribe</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright-reserved">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-text">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | This
                            template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a
                                href="https://www.facebook.com" target="_blank">facebook</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </div>
                        <div class="payment-pic">
                            <img src="img/payment-method.png" alt="">
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
        var inputElement = document.getElementById('inputQuantity');
        inputElement.addEventListener('input', function() {
            var inputValue = parseInt(inputElement.value);
            var max = parseInt(inputElement.getAttribute('max'));

            if (inputValue > max) {
                inputElement.value = max; // Đặt giá trị thành giá trị max nếu vượt quá
                toastify().warning(`Số lượng vượt quá ${max}`);
            }
        });
    </script>
    <script>
        function previewImage(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImage').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

    <script>
        function previewImageUpdate(event) {
            var input = event.target;
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    document.getElementById('previewImgUpdate').src = e.target.result;
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            var cityProvinceSelect = $('#city_province');
            var districtSelect = $('#district');
            var wardsSelect = $('#wards');
            cityProvinceSelect.on('change', function() {
                var selectedCityProvince = $(this).val();
                $.ajax({
                    url: '/get-districts/' + cityProvinceSelect,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        cityProvince: selectedCityProvince
                    },
                    success: function(response) {
                        districtSelect.empty();
                        wardsSelect.empty();

                        response.forEach(function(district) {
                            districtSelect.append('<option value="' + district.maqh +
                                '">' + district.name_quanhuyen + '</option>');
                        });
                    }
                });
            });

            districtSelect.on('change', function() {
                var selectedDistrict = $(this).val();
                $.ajax({
                    url: '/get-wards/' + selectedDistrict,
                    type: 'GET',
                    data: {
                        _token: '{{ csrf_token() }}',
                        district: selectedDistrict
                    },
                    success: function(response) {
                        wardsSelect.empty();
                        response.forEach(function(wards) {
                            wardsSelect.append('<option value="' + wards.xaid + '">' +
                                wards.name_xaphuong + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</body>

</html>
