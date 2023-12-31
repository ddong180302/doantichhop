<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Trang chi tiết sản phẩm</title>

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
        .product-gallery {
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #ddd;
            overflow: hidden;
        }

        .product-images {
            display: flex;
        }

        .product-image {
            width: 100px;
            margin-right: 10px;
            cursor: pointer;
        }

        .product-image:hover {
            opacity: 0.7;
            cursor: pointer;
        }

        .gallery-slider {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            display: flex;
            justify-content: center;
            align-items: center;
            visibility: hidden;
            opacity: 0;
            transition: visibility 0s, opacity 0.3s;
            z-index: 1000000000000000000;
        }

        .close-slider {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 24px;
            color: #fff;
            cursor: pointer;
        }

        .slider-images {
            display: flex;
        }

        .slider-image {

            width: 900px;
            height: 600px;
            margin-right: 10px;
        }

        .slider-navigation {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .prev-slide,
        .next-slide {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 24px;
            color: #000;
            background-color: #45d6e9;
            cursor: pointer;
            padding: 5px 16px;
            border-radius: 50%;
            /* Thêm các thuộc tính khác cho nút điều hướng nếu cần */
        }

        .prev-slide {
            left: 30px;
        }

        .next-slide {
            right: 30px;
        }

        .hide {
            display: none;
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
                                <button type="submit" name="search_items"><i class="ti-search"></i></button>
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
                                @if (Auth::user())
                                    <div class="cart-hover">
                                        <div id="change-item-cart">
                                            @if ($cart)
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
                                                                        <i class="ti-close"
                                                                            data-id="{{ $item->product_id }}"></i>
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
                                            @else
                                                <div>Giỏ hàng trống</div>
                                            @endif
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
                            @if (Auth::user() && Auth::user()->user_role === 'QUANTRIVIEN')
                                <li><a href="{{ URL::to('/dashboard') }}">Trang quản trị</a></li>
                            @endif
                        @endif
                        @if (Auth::user())
                            <li><a href="{{ URL::to('/show-cart/' . Auth::user()->user_id) }}">Giỏ hàng</a></li>
                            <li><a href="{{ URL::to('/show-user-profile/' . Auth::user()->user_id) }}">Trang cá
                                    nhân</a>
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
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <!-- Giỏ Hàng Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 order-1 order-lg-2">
                    <div class="product-list">
                        <div class="row">
                            <div class="row">
                                <h2
                                    style="display: flex; justify-content: center; padding-bottom: 20px; border-bottom: 1px solid #ebebeb;">
                                    Chi tiết
                                    sản phẩm</h2>
                            </div>
                            <div class="row" style="padding: 50px; border-bottom: 2px solid #ddd;">
                                <div class="col-lg-6">
                                    <div>
                                        <img src="{{ URL::to('public/uploads/product/' . $detail_product->product_image) }}"
                                            alt="" id="mainImage">
                                    </div>
                                    <div style="margin-top: 20px">
                                        <div class="product-gallery">
                                            <div class="product-images">
                                                @foreach ($gallery as $item)
                                                    <img src="{{ URL::to('public/uploads/product/' . $item->gallery_image) }}"
                                                        alt="Product Image 1" class="product-image">
                                                    {{-- onmouseover="changeImage('{{ $item->gallery_image }}')"
                                                        onmouseout="resetImage()" onclick="changeImage('{{ $item->gallery_image }}')" --}}
                                                @endforeach
                                            </div>
                                            <div class="gallery-slider">
                                                <span class="close-slider">&times;</span>
                                                <div class="slider-images">
                                                    <img src="" alt="Product Image 1" class="slider-image">
                                                </div>
                                                <div class="slider-navigation">
                                                    <span class="prev-slide">&lt;</span>
                                                    <span class="next-slide">&gt;</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6" style="padding-left: 60px" id="detail-cart">
                                    <div style="padding-bottom: 15px; color: black">
                                        Tên sản phẩm
                                        <h3>{{ $detail_product->product_name }}</h3>
                                    </div>
                                    <div style="padding-bottom: 15px; color: black">
                                        Thương hiệu
                                        <h3>{{ $detail_product->category_name }}</h3>
                                    </div>
                                    <div style="padding-bottom: 15px; color: black">
                                        Giá sản phẩm
                                        <h4>{{ number_format($detail_product->product_price) }} vnđ</h4>
                                    </div>
                                    <div style="padding-bottom: 15px; color: black">
                                        Sản phẩm đã bán
                                        <h4>{{ $detail_product->product_sold }}</h4>
                                    </div>
                                    <div style="padding-bottom: 15px; color: black">
                                        Sản phẩm trong kho
                                        <h4>{{ $detail_product->product_quantity }}</h4>
                                    </div>
                                    <div style="padding-bottom: 15px; color: black">
                                        Ngày nhập hàng
                                        <h4>{{ $detail_product->created_at }}</h4>
                                    </div>
                                    <div style="padding-bottom: 10px">
                                        <input
                                            style="width: 70px; outline: none; border: 2px solid #333; padding: 5px; text-align: center; border-radius: 5px; color: black; font-size: 16px"
                                            type="number" value="1" min="1"
                                            max="{{ $detail_product->product_quantity }}" id="inputQuantity">
                                    </div>
                                    <div class="them">
                                        @if (Auth::user())
                                            <a id="addToCartLink"
                                                href="{{ URL::to('/add-cart-detail/' . $detail_product->product_id . '/' . Auth::user()->user_id) . '/' . 1 }}">
                                                <button class="btn btn-primary btn-them">
                                                    Thêm vào giỏ hàng
                                                </button>
                                            </a>
                                        @else
                                            <a href="{{ URL::to('/login') }}">
                                                <button class="btn btn-primary btn-them">
                                                    Thêm vào giỏ hàng
                                                </button>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12" style="display: flex; justify-content: center; padding: 60px 0">
                                <h2>Thông số kỹ thuật</h2>
                            </div>
                            <div class="col-lg-12">
                                <table style="border-collapse: collapse">
                                    <tbody style="border: 2px solid #333;">
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    CPU
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->cpu }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    RAM
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->ram }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Storage
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px;  border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->storage }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Graphics Card
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->graphics_card }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px ; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Screen
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->screen }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Connectivity Ports
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->connectivity_ports }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Weight
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->weight }}</span>
                                            </td>
                                        </tr>
                                        <tr style="height: 60px; border: 2px solid #333;">
                                            <td style="width: 11%; height: 60px; padding:30px">
                                                <span style="font-size: 14pt; font-family: 'times new roman', times;">
                                                    Battery
                                                </span>
                                            </td>
                                            <td
                                                style="width: 89%; height: 60px; border-left: 2px solid #333;padding:30px ">
                                                <span
                                                    style="font-size: 14pt; font-family: 'times new roman', times;">{{ $detail_product->battery }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Giỏ Hàng Section End -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
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
    {{-- <script src="{{ asset('public/user/js/gallery.js') }}"></script> --}}
    <script>
        var inputElement = document.getElementById('inputQuantity');
        inputElement.addEventListener('input', function(event) {
            const value = event.target.value;
            const sanitizedValue = value.replace(/[-+]/g, '');
            event.target.value = sanitizedValue;

            var regex = /^[0-9]+$/;
            var isValid = regex.test(event.target.value);
            var inputValue = parseInt(inputElement.value);
            var max = parseInt(inputElement.getAttribute('max'));

            if (!isValid) {
                toastify().warning('Vui lòng chỉ nhập số.');
                event.target.value = '';
            }

            if (inputValue > max) {
                inputElement.value = max; // Đặt giá trị thành giá trị max nếu vượt quá
                toastify().warning('Số lượng vượt quá ' + max);
            }

            if (inputValue < 1) {
                inputValue = inputValue; // Đặt giá trị thành giá trị value nếu vượt quá
                toastify().warning('Số lượng không được nhỏ hơn 1');
            }
        });
    </script>
    @if (Auth::user())
        <script>
            var inputQuantity = document.getElementById('inputQuantity');
            var addToCartLink = document.getElementById('addToCartLink');

            inputQuantity.addEventListener('change', function() {
                var quantity = inputQuantity.value;
                var href =
                    "{{ URL::to('/add-cart-detail/' . $detail_product->product_id . '/' . Auth::user()->user_id) . '/' }}" +
                    quantity;
                addToCartLink.href = href;
            });
        </script>
    @endif

    <script>
        const productImages = document.querySelectorAll('.product-image');
        const gallerySlider = document.querySelector('.gallery-slider');
        const sliderImage = document.querySelector('.slider-image');
        const closeSlider = document.querySelector('.close-slider');
        const prevSlide = document.querySelector('.prev-slide');
        const nextSlide = document.querySelector('.next-slide');

        let currentIndex = 0;

        function showSlider() {
            gallerySlider.style.visibility = 'visible';
            gallerySlider.style.opacity = '1';
        }

        function hideSlider() {
            gallerySlider.style.visibility = 'hidden';
            gallerySlider.style.opacity = '0';
        }

        function updateSlider() {
            if (currentIndex === 0) {
                prevSlide.classList.add('hide');
            } else {
                prevSlide.classList.remove('hide');
            }

            if (currentIndex === productImages.length - 1) {
                nextSlide.classList.add('hide');
            } else {
                nextSlide.classList.remove('hide');
            }
        }

        function showImage(index) {
            const selectedImage = productImages[index].src;
            sliderImage.src = selectedImage;
            updateSlider();
        }

        productImages.forEach((image, index) => {
            image.addEventListener('click', () => {
                currentIndex = index;
                showImage(currentIndex);
                showSlider();
            });
        });

        closeSlider.addEventListener('click', () => {
            hideSlider();
        });

        prevSlide.addEventListener('click', () => {
            if (currentIndex > 0) {
                currentIndex--;
                showImage(currentIndex);
            }
        });

        nextSlide.addEventListener('click', () => {
            if (currentIndex < productImages.length - 1) {
                currentIndex++;
                showImage(currentIndex);
            }
        });

        // Ẩn nút điều hướng trước khi slider được khởi tạo
        prevSlide.classList.add('hide');
        nextSlide.classList.add('hide');
    </script>

    {{-- <script>
        function changeImage(imageUrl) {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = "{{ URL::to('public/uploads/product/') }}" + '/' + imageUrl;
        }
    </script> --}}

    {{-- <script>
        function changeImage(imageUrl) {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = "{{ URL::to('public/uploads/product/') }}" + '/' + imageUrl;
        }

        function resetImage() {
            var mainImage = document.getElementById('mainImage');
            mainImage.src = "{{ URL::to('public/uploads/product/' . $detail_product->product_image) }}";
        }
    </script> --}}
</body>

</html>
