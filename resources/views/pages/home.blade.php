@extends('index')
@section('content')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif

    <div class="row" style="padding-bottom: 40px">
        <form action="">
            @csrf
            <select name="filter_option" id="filter-option" style="padding: 10px; border: 1px solid #333; border-radius: 5px">
                <option value="{{ URL::to('/filter') }}?sort_by=moinhat">Mới Nhất</option>
                <option value="{{ URL::to('/filter') }}?sort_by=tuA_Z">Từ A-Z</option>
                <option value="{{ URL::to('/filter') }}?sort_by=tuZ_A">Từ Z-A</option>
                <option value="{{ URL::to('/filter') }}?sort_by=tangdan">Giá từ Thấp Đến Cao</option>
                <option value="{{ URL::to('/filter') }}?sort_by=giamdan">Giá từ Cao Đến Thấp</option>
                <option value="{{ URL::to('/filter') }}?sort_by=banchay">Bán Chạy Nhất</option>
            </select>
        </form>
    </div>
    <div class="row" id="product-list">
        @foreach ($all_product as $key => $product)
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
    <div id="pagination-container">
        {{ $all_product->links() }}
    </div>
@endsection
