<!--A Design by Nhóm 4
Author: Nhóm 4
-->
<!DOCTYPE html>

<head>
    <title>Đăng ký tài khoản</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <!-- bootstrap-css -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/bootstrap.min.css') }}">
    <!-- //bootstrap-css -->
    <!-- Custom CSS -->
    <link href="{{ asset('public/backend/css/style.css') }}" rel='stylesheet' type='text/css' />
    <link href="{{ asset('public/backend/css/style-responsive.css') }}" rel="stylesheet" />
    <!-- font CSS -->
    <link
        href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>
    <!-- font-awesome icons -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/font.css') }}" type="text/css" />
    <link href="{{ asset('public/backend/css/font-awesome.css') }}" rel="stylesheet">
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    @toastifyCss
    @toastifyJs
</head>

<body>
    <div class="log-w3">
        <div class="w3layouts-main">
            <h2>Đăng Ký</h2>
            @if (session('message'))
                <script>
                    toastify().success('{{ session('message') }}');
                </script>
            @endif

            @if (session('error'))
                <script>
                    toastify().success('{{ session('error') }}');
                </script>
            @endif

            <form action="{{ URL::to('/register-auth') }}" method="POST">
                {{ csrf_field() }}
                <input type="email" class="ggg" name="user_email" placeholder="Nhập Email">
                <input type="password" class="ggg" name="user_password" placeholder="Nhập mật khẩu">
                <input type="text" class="ggg" name="user_name" placeholder="Nhập họ tên">
                <input type="text" class="ggg" name="user_phone" placeholder="Nhập số điện thoại">
                Đã đăng ký? <a href="{{ URL::to('/login') }}">Đăng Nhập</a>
                <div class="clearfix"></div>
                <input type="submit" value="Đăng Ký" name="register">
            </form>
        </div>
    </div>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <!--[if lte IE 8]><script language="javascript" type="text/javascript" src="js/flot-chart/excanvas.min.js"></script><![endif]-->
    <script>
        'toastifiers' => [
            'custom' => [
                'duration' => 5000,
                'gravity' => top,
                'positionRight' => true,
                // 'style' => [
                //     'background' => '#000',
                //     'color' => '#fff',
                // ],
            ],
        ],
    </script>
    <script src="{{ asset('public/backend/js/jquery.scrollTo.js') }}"></script>
</body>

</html>
