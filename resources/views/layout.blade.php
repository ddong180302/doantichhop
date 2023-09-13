<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">
    {{-- <meta name="description" content="{{$meta_desc}}">
    <meta name="keywords" content="{{$meta_keywords}}">
    <meta name="robots" content="INDEX,FOLLOW">
    <link rel="canonical" href="{{$link_url}}" />
    <link rel="icon" type="image/x-icon" href="{{$link_url}}"/> --}}
    {{-- <meta property="og:image" content="{{$image_og}}" />; --}}
    {{-- <meta property="og:site_name" content="{{$link_url}}" />
    <meta property="og:description" content="{{$meta_desc}}" />
    <meta property="og:title" content="{{$meta_title}}" />
    <meta property="og:url" content="{{$link_url}}" /> --}}
    <meta property="og:type" content="website" />
    <meta property="fb:app_id" content="&#123;YOUR_APP_ID&#125;" />
    <meta property="fb:admins" content="&#123;YOUR_FACEBOOK_USER_ID&#125;"/>
    <meta property="fb:admins" content="&#123;YOUR_FACEBOOK_USER_ID_1&#125;"/>
    <meta property="fb:admins" content="&#123;YOUR_FACEBOOK_USER_ID_2&#125;"/>
    <title>Trang chủ</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
    <link rel="shortcut icon" href="{{{'public/frontend/images/favicon.ico'}}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
    @toastifyCss
    @toastifyJs
</head><!--/head-->

<body>
    <header id="header"><!--header-->
        <div class="header_top"><!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +84 932 562 365</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> trandangdong18032002@gmail.com</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header_top-->

        <div class="header-middle"><!--header-middle-->
            <div class="container">
                <div class="row">
                        @if (session('message'))
                            <script>
                                toastify().success('{{ session('message') }}');
                            </script>
                        @endif
                    <div class="col-sm-12">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>

                                <?php
                                    $user = Session::get('user');
                                    $shipping_id = Session::get('shipping_id');
                                    if($user != NULL && $shipping_id==NULL) {
                                ?>
                                     <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }elseif($user != NULL && $shipping_id!=NULL) {
                                ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
                                <?php
                                    }
                                ?>
                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                <?php
                                    $user = Session::get('user');
                                    if($user != NULL) {
                                ?>
                                        <ul class="nav pull-right top-menu">
                                            <li class="dropdown">
                                                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                                    <img alt="" src="{{ asset('public/backend/images/2.png') }}">
                                                    <span class="username">
                                                        <?php
                                                        $name = Session::get('user');
                                                        if ($name && $user->user_name) {
                                                            echo $user->user_name;
                                                        }
                                                        ?>
                                                    </span>
                                                    <b class="caret"></b>
                                                </a>
                                                <ul class="dropdown-menu extended logout">
                                                    <li><a href="#"><i class=" fa fa-suitcase"></i>   Thông tin cá nhân</a></li>
                                                    <li><a href="#"><i class="fa fa-cog"></i>   Trang quản trị</a></li>
                                                    <li><a href="{{ URL::to('logout-auth') }}"><i class="fa fa-key"></i>   Đăng xuất</a></li>
                                                </ul>
                                            </li>
                                            <!-- user login dropdown end -->
                                        </ul>
                                <?php
                                    }else {
                                ?>
                                    <li><a href="{{URL::to('/login')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header-middle-->
        <!--header-bottom-->
        <div class="header-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-7">
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                <li><a href="{{URL::to('/trang-chu')}}" class="active">Trang chủ</a></li>
                                <li class="dropdown"><a href="#">Sản phẩm<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Sản phẩm</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown">
                                    <a href="#">Tin tức<i class="fa fa-angle-down"></i></a>
                                </li>
                                <li><a href="{{URL::to('/gio-hang')}}">Giỏ hàng</a></li>
                                <li><a href="contact-us.html">Liên hệ</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-5">
                        <form action={{URL::to('/tim-kiem')}} method="POST">
                            {{ csrf_field() }}
                            <div class="search_box pull-right">
                                <input class="input-text" type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
                                <input class="input-submit" type="submit" name="search_items" class="btn btn-primary btn-sm" value="Tìm kiếm"/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div><!--/header-bottom-->
        <!--header-category-->
        <div class="header-category">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="mainmenu pull-left">
                            <ul class="nav navbar-nav collapse navbar-collapse">
                                 @foreach ($category as $key => $cate)
                                <li>
                                    <a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a>
                                </li>
                            @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div><!--/header-category-->

    </header><!--/header-->
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                   @yield('content')
                </div>
            </div>
        </div>
    </section>
    <!--Footer-->
    <footer id="footer">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <p class="pull-left">Nhóm 2, Đồ án tích hợp</p>
                    <p class="pull-right">Designed by Nhóm 2</p>
                </div>
            </div>
        </div>

    </footer>
    <!--/Footer-->



    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
    <script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <div id="fb-root"></div>
   <div id="fb-root"></div>
     <script type="text/javascript">
        $(document).ready(function(){
            $('.add-to-cart').click(function(){

                var id = $(this).data('id_product');
                // alert(id);
                var cart_product_id = $('.cart_product_id_' + id).val();
                var cart_product_name = $('.cart_product_name_' + id).val();
                var cart_product_image = $('.cart_product_image_' + id).val();
                var cart_product_quantity = $('.cart_product_quantity_' + id).val();
                var cart_product_price = $('.cart_product_price_' + id).val();
                var cart_product_qty = $('.cart_product_qty_' + id).val();
                var _token = $('input[name="_token"]').val();
                if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
                    alert('Làm ơn đặt nhỏ hơn ' + cart_product_quantity);
                }else{

                    $.ajax({
                        url: '{{url('/add-cart-ajax')}}',
                        method: 'POST',
                        data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,_token:_token,cart_product_quantity:cart_product_quantity},
                        success:function(){

                            swal({
                                    title: "Đã thêm sản phẩm vào giỏ hàng",
                                    text: "Bạn có thể mua hàng tiếp hoặc tới giỏ hàng để tiến hành thanh toán",
                                    showCancelButton: true,
                                    cancelButtonText: "Xem tiếp",
                                    confirmButtonClass: "btn-success",
                                    confirmButtonText: "Đi đến giỏ hàng",
                                    closeOnConfirm: false
                                },
                                function() {
                                    window.location.href = "{{url('/gio-hang')}}";
                                });

                        }

                    });
                }


            });
        });
    </script>
     <script type="text/javascript">
        $(document).ready(function(){
            $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';

            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url : '{{url('/select-delivery-home')}}',
                method: 'POST',
                data:{action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                   $('#'+result).html(data);
                }
            });
        });
        });

    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('.calculate_delivery').click(function(){
                var matp = $('.city').val();
                var maqh = $('.province').val();
                var xaid = $('.wards').val();
                var _token = $('input[name="_token"]').val();
                if(matp == '' && maqh =='' && xaid ==''){
                    alert('Làm ơn chọn để tính phí vận chuyển');
                }else{
                    $.ajax({
                    url : '{{url('/calculate-fee')}}',
                    method: 'POST',
                    data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
                    success:function(){
                       location.reload();
                    }
                    });
                }
        });
    });
    </script>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v17.0" nonce="bsPuLgVB"></script>
</body>
</html>