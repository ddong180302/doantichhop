@extends('users')
@section('user')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Mã đơn hàng</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá sản phẩm</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Ngày mua hàng</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_detail as $item)
                    <tr>
                        <th scope="row">{{ $item->order_id }}</th>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ number_format($item->product_price) }} đ</td>
                        <td>{{ $item->product_quantity }}</td>
                        <td>{{ DATE_FORMAT($item->created_at, 'H:i:s - d-m-Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
