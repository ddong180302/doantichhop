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

        .profile-layout .profile-info .address {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .profile-layout .profile-info .address .address-name {
            margin-right: 10px;
        }

        .profile-layout .profile-info .address .address-name .title-info {
            padding-bottom: 5px;
            text-align: center;
            align-items: center;
        }

        .profile-layout .change-password {
            width: 60%;
            margin: 0 auto;
            padding: 20px;
            border-radius: 10px;
            background: #87eec1;
        }

        .profile-layout .change-password .change-title {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            width: 100%;
            padding: 10px 0;
        }

        .profile-layout .change-password .title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            padding: 20px 0;
            display: flex;
            justify-content: center
        }

        .profile-layout .change-password .change-title .title-info {
            width: 40%;
        }

        .profile-layout .change-password .change-title .title-info .label {
            font-family: sans-serif;
            font-size: 20px;
        }

        .profile-layout .change-password .change-title .info-name {
            width: 60%;
        }

        .profile-layout .change-password .change-title .info-name .input {
            border: 2px solid #ddd;
            border-radius: 5px;
            padding: 5px;
            width: 100%;
            position: relative;
        }

        .profile-layout .change-password .change-title .info-name .show-password {
            font-size: 20px;
            position: absolute;
            transform: translate(-180%, 50%);
            cursor: pointer;
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
                        <li><a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}">Trang cá nhân</a>
                        </li>
                        <li><a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}">Giỏ hàng</a></li>
                        @if (Auth::user())
                            @if (Auth::user() && Auth::user()->user_role === 'QUANTRIVIEN')
                                <li><a href="{{ URL::to('/dashboard') }}">Trang quản trị</a></li>
                            @endif
                        @endif
                        @if (Auth::user())
                            <li>
                                <a href="{{ URL::to('/show-order-history/' . Auth::user()->user_id) }}">
                                    Lịch sử mua hàng
                                </a>
                            </li>
                        @endif
                        <li><a href="{{ URL::to('/show-change-password-user/' . Auth::user()->user_id) }}">Đổi mật
                                khẩu</a>
                        </li>
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
    <script>
        // Lấy các phần tử form và nút điều khiển
        const viewForm = document.getElementById('viewForm');
        const editForm = document.getElementById('editForm');
        const editButton = document.getElementById('editButton');
        const cancelButton = document.getElementById('cancelButton');

        // Xử lý sự kiện khi nhấn nút "Thay đổi thông tin"
        editButton.addEventListener('click', function() {
            viewForm.style.display = 'none';
            editForm.style.display = 'block';
        });

        // Xử lý sự kiện khi nhấn nút "Hủy"
        cancelButton.addEventListener('click', function() {
            viewForm.style.display = 'block';
            editForm.style.display = 'none';
        });
    </script>

    <script>
        const passwordInput1 = document.getElementById('passwordInput1');
        const togglePassword1 = document.getElementById('togglePassword1');



        togglePassword1.addEventListener('click', function() {
            const type = passwordInput1.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput1.setAttribute('type', type);
            togglePassword1.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        const passwordInput2 = document.getElementById('passwordInput2');
        const togglePassword2 = document.getElementById('togglePassword2');

        togglePassword2.addEventListener('click', function() {
            const type = passwordInput2.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput2.setAttribute('type', type);
            togglePassword2.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        const passwordInput3 = document.getElementById('passwordInput3');
        const togglePassword3 = document.getElementById('togglePassword3');

        togglePassword3.addEventListener('click', function() {
            const type = passwordInput3.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput3.setAttribute('type', type);
            togglePassword3.classList.toggle('fa-eye-slash');
        });
    </script>

    <script>
        document.querySelector('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn chuyển hướng mặc định khi submit form

            // Lấy giá trị của các trường mật khẩu
            var passwordInput2 = document.getElementById('passwordInput2').value;
            var passwordInput3 = document.getElementById('passwordInput3').value;

            // Kiểm tra mật khẩu nhập lại có khớp với mật khẩu mới hay không
            if (passwordInput2 !== passwordInput3) {
                // Mật khẩu nhập lại không khớp, hiển thị thông báo hoặc thực hiện hành vi tương ứng
                alert('Mật khẩu nhập lại không khớp. Vui lòng nhập lại!');
                document.getElementById('passwordInput2').value = ''; // Xóa giá trị trường mật khẩu mới
                document.getElementById('passwordInput3').value = ''; // Xóa giá trị trường xác thực mật khẩu mới
                document.getElementById('passwordInput2').focus(); // Focus vào trường mật khẩu mới
            } else {
                // Mật khẩu nhập lại khớp, tiếp tục chuyển hướng đến URL /change-password
                this.submit();
            }
        });
    </script>
</body>

</html>
