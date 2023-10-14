<!--A Design by Nhóm 4
Author: NHóm 4
-->
<!DOCTYPE html>

<head>
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords"
        content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
        Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
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
    <link rel="stylesheet" href="{{ asset('public/backend/css/morris.css') }}" type="text/css" />
    <!-- calendar -->
    <link rel="stylesheet" href="{{ asset('public/backend/css/monthly.css') }}">
    <!-- //calendar -->
    <!-- //font-awesome icons -->
    <script src="{{ asset('public/backend/js/jquery2.0.3.min.js') }}"></script>
    <script src="{{ asset('public/backend/js/raphael-min.js') }}"></script>
    <script src="{{ asset('public/backend/js/morris.js') }}"></script>
    @toastifyCss
    @toastifyJs
    <style>
        /* hover thêm image product */
        .hover-add-image {
            position: relative;
            display: inline-block;
        }

        .hover-add-image::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            width: 50px;
            transform: translateX(-50%);
            background-color: #1cc6cf;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1;
        }

        .hover-add-image:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .hover-add-image:hover::before {
            content: "Thêm hình ảnh";
        }

        /* hover edit product */
        .hover-edit-product {
            position: relative;
            display: inline-block;
        }

        .hover-edit-product::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            width: 50px;
            transform: translateX(-50%);
            background-color: #1cc6cf;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1;
        }

        .hover-edit-product:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .hover-edit-product:hover::before {
            content: "Sửa sản phẩm";
        }

        /* hover delete product */
        .hover-delete-product {
            position: relative;
            display: inline-block;
        }

        .hover-delete-product::before {
            content: "";
            position: absolute;
            top: 100%;
            left: 50%;
            width: 50px;
            transform: translateX(-50%);
            background-color: #1cc6cf;
            color: #fff;
            padding: 5px;
            border-radius: 3px;
            opacity: 0;
            visibility: hidden;
            transition: opacity 0.3s ease, visibility 0.3s ease;
            z-index: 1;
        }

        .hover-delete-product:hover::before {
            opacity: 1;
            visibility: visible;
        }

        .hover-delete-product:hover::before {
            content: "Xóa sản phẩm";
        }
    </style>
</head>

<body>
    <section id="container">
        <!--header start-->
        <header class="header fixed-top clearfix">
            <!--logo start-->
            <div class="brand">
                <a href="{{ URL::to('/') }}" class="logo">
                    QUẢN TRỊ
                </a>
                <div class="sidebar-toggle-box">
                    <div class="fa fa-bars"></div>
                </div>
            </div>
            <div class="top-nav clearfix">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="{{ asset('public/uploads/user/' . Auth::user()->user_avatar) }}">
                            <span class="username">
                                <?php
                                if (Auth::user()) {
                                    $name = Auth::user()->user_name;
                                    if ($name) {
                                        echo $name;
                                    }
                                }
                                ?>
                            </span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <li><a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}"><i
                                        class=" fa fa-suitcase"></i>Trang cá nhân</a></li>
                            <li><a href="{{ URL::to('/') }}"><i class="fa fa-cog"></i> Trang chủ</a></li>
                            <li><a href="{{ URL::to('logout-auth') }}"><i class="fa fa-key"></i> Đăng xuất</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
        <!--header end-->
        <!--sidebar start-->
        <aside>
            <div id="sidebar" class="nav-collapse">
                <!-- sidebar menu start-->
                <div class="leftside-navigation">
                    <ul class="sidebar-menu" id="nav-accordion">
                        <li>
                            <a href="{{ URL::to('/dashboard') }}">
                                <i class="fa fa-dashboard"></i>
                                <span>Tổng quan</span>
                            </a>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Đơn hàng</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/manage-order') }}">Quản lý đơn hàng</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Danh mục sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/add-category-product') }}">Thêm danh mục sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/get-all-category-product') }}">Liệt kê danh mục sản phẩm</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Phương thức thanh toán</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/show-add-payment') }}">Thêm phương thức thanh toán</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/get-all-payment') }}">Liệt kê phương thức thanh toán</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Sản phẩm</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/add-product') }}">Thêm sản phẩm</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/get-all-product') }}">Liệt kê sản phẩm</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Thông số kỹ thuật</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/add-specifications') }}">Thêm thông số kỹ thuật sản phẩm</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="javascript:;">
                                <i class="fa fa-book"></i>
                                <span>Người Dùng</span>
                            </a>
                            <ul class="sub">
                                <li>
                                    <a href="{{ URL::to('/show-add-user') }}">Thêm người dùng</a>
                                </li>
                                <li>
                                    <a href="{{ URL::to('/get-all-user ') }}">Liệt kê người dùng</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- sidebar menu end-->
            </div>
        </aside>
        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
            <section class="wrapper">
                @yield('admin_content')
            </section>
            <!-- footer -->
            <div class="footer">
                <div class="wthree-copyright">
                    Được thực hiện bởi nhóm 2 vào năm
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </div>
            </div>
            <!-- / footer -->
        </section>
        <!--main content end-->
    </section>
    <script src="{{ asset('public/backend/js/bootstrap.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('public/backend/js/scripts.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('public/backend/js/jquery.nicescroll.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#filter-product').on('change', function() {
                var url = $(this).val();
                if (url) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('#table-container').html(data);
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                }
                return false;
            });
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('#filter-category').on('change', function() {
                var url = $(this).val();
                if (url) {
                    $.ajax({
                        url: url,
                        type: 'GET',
                        success: function(data) {
                            $('#table-category-container').html(data);
                        },
                        error: function(error) {
                            alert(error);
                        }
                    });
                }
                return false;
            });
        });
    </script>


    <script>
        function searchProduct() {
            // Lấy giá trị từ ô input tìm kiếm
            var keyProduct = document.querySelector('input[name="key_product"]').value;

            // Tạo yêu cầu AJAX để tìm kiếm sản phẩm
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Cập nhật phần giao diện cần reload
                    document.getElementById('table-container').innerHTML = this.responseText;
                }
            };
            // Tạo dữ liệu yêu cầu
            var data = new FormData();
            data.append('key_product', keyProduct);
            data.append('_token', '{{ csrf_token() }}');

            // Gửi yêu cầu POST AJAX
            xhttp.open("POST", "{{ URL::to('/search-product') }}", true);
            xhttp.send(data);
        }
    </script>

    <script>
        function searchCategory() {
            // Lấy giá trị từ ô input tìm kiếm
            var keyCate = document.querySelector('input[name="key_cate"]').value;

            // Tạo yêu cầu AJAX để tìm kiếm sản phẩm
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Cập nhật phần giao diện cần reload
                    document.getElementById('table-category-container').innerHTML = this.responseText;
                }
            };

            // Tạo dữ liệu yêu cầu
            var data = new FormData();
            data.append('key_cate', keyCate);
            data.append('_token', '{{ csrf_token() }}');

            // Gửi yêu cầu POST AJAX
            xhttp.open("POST", "{{ URL::to('/search-cate') }}", true);
            xhttp.send(data);
        }
    </script>

    <script>
        function searchUsers() {
            // Lấy giá trị từ ô input tìm kiếm
            var keyUsers = document.querySelector('input[name="key_users"]').value;

            // Tạo yêu cầu AJAX để tìm kiếm sản phẩm
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Cập nhật phần giao diện cần reload
                    document.getElementById('table-users-container').innerHTML = this.responseText;
                }
            };

            // Tạo dữ liệu yêu cầu
            var data = new FormData();
            data.append('key_users', keyUsers);
            data.append('_token', '{{ csrf_token() }}');

            // Gửi yêu cầu POST AJAX
            xhttp.open("POST", "{{ URL::to('/search-users') }}", true);
            xhttp.send(data);
        }
    </script>

    <script>
        function searchPayment() {
            // Lấy giá trị từ ô input tìm kiếm
            var keyPayment = document.querySelector('input[name="key_payment"]').value;

            // Tạo yêu cầu AJAX để tìm kiếm sản phẩm
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Cập nhật phần giao diện cần reload
                    document.getElementById('table-payment-container').innerHTML = this.responseText;
                }
            };

            // Tạo dữ liệu yêu cầu
            var data = new FormData();
            data.append('key_payment', keyPayment);
            data.append('_token', '{{ csrf_token() }}');

            // Gửi yêu cầu POST AJAX
            xhttp.open("POST", "{{ URL::to('/search-payment') }}", true);
            xhttp.send(data);
        }
    </script>




    {{-- <script>
        document.getElementById('filter-form').addEventListener('submit', function(event) {
            event.preventDefault(); // Ngăn chặn gửi yêu cầu form mặc định

            var startDate = document.getElementById('start-date').value;
            var endDate = document.getElementById('end-date').value;

            var xhr = new XMLHttpRequest();
            xhr.open('GET', '/filter-dashboard?start_date=' + startDate + '&end_date=' + endDate, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    displayResults(response);
                }
            };
            xhr.send();
        });

        function displayResults(data) {
            var resultContainer = document.getElementById('result-container');
            resultContainer.innerHTML = ''; // Xóa kết quả cũ (nếu có)

            if (data.length === 0) {
                resultContainer.innerText = 'Không có kết quả phù hợp.';
                return;
            }

            var ul = document.createElement('ul');
            data.forEach(function(item) {
                var li = document.createElement('li');
                li.innerText = item.name;
                ul.appendChild(li);
            });

            resultContainer.appendChild(ul);
        }
    </script> --}}
</body>

</html>
