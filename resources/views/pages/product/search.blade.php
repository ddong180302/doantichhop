@extends('index')
@section('content')
    <div class="row"
        style="padding-bottom: 30px; text-align: center; align-items: center; display: flex; justify-content: center; border-bottom: 1px solid #ddd">
        <h2 class="title text-center">Sản phẩm đã tìm kiếm</h2>
    </div>
    <div class="row" style="padding-top: 30px">
        @foreach ($search_product as $key => $product)
            <div class="col-lg-4 col-sm-6">
                <div class="product-item">
                    <div class="pi-pic">
                        <img src="{{ URL::to('public/uploads/product/' . $product->product_image) }}" alt="">
                        <ul>
                            @if (Auth::user())
                                <li class="quick-view">
                                    <a onclick="AddCart({{ $product->product_id }}, {{ Auth::user()->user_id }})"
                                        href="{{ URL::to('/add-cart/' . $product->product_id . '/' . Auth::user()->user_id) }}">
                                        Thêm vào giỏ hàng
                                    </a>
                                </li>
                            @else
                                <li class="quick-view">
                                    <a href="{{ URL::to('/login') }}">
                                        Thêm vào giỏ hàng
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="pi-text">
                        <a href="{{ URL::to('/chi-tiet-san-pham/' . $product->product_id) }}">
                            <h5>{{ $product->product_name }}</h5>
                        </a>
                        <div class="product-price">
                            {{ number_format($product->product_price) }} vnđ
                        </div>
                        <div class="" style="color: black">
                            Đã bán: {{ $product->product_sold }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
