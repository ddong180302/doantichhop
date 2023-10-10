@extends('users')
@section('user')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div style="display: flex; justify-content: center; padding-bottom: 20px">
        <h3>Chi tiết lịch sử đơn mua hàng</h3>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center; align-items: center">Mã chi tiết đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Mã đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Tên sản phẩm</th>
                    <th scope="col" style="text-align: center; align-items: center">Hình ảnh sản phẩm</th>
                    <th scope="col" style="text-align: center; align-items: center">Giá sản phẩm</th>
                    <th scope="col" style="text-align: center; align-items: center">Số lượng sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order_detail as $item)
                    <tr>
                        <td style="text-align: center; align-items: center" scope="row">{{ $item->order_details_id }}
                        </td>
                        <td style="text-align: center; align-items: center">{{ $item->order_id }}</td>
                        <td style="text-align: center; align-items: center">{{ $item->product_name }}</td>
                        <td style="text-align: center; align-items: center"><img
                                src={{ URL::to('public/uploads/product/' . $item->product_image) }} height="100"
                                width="150"></td>
                        <td style="text-align: center; align-items: center">{{ $item->product_price }}</td>
                        <td style="text-align: center; align-items: center">{{ $item->product_quantity }}</td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
