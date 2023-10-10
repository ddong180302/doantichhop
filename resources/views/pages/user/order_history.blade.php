@extends('users')
@section('user')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div style="display: flex; justify-content: center; padding: 20px 0">
        <h3>Lịch sử mua hàng</h3>
    </div>
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center; align-items: center">Mã đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Tên người mua</th>
                    <th scope="col" style="text-align: center; align-items: center">Trạng thái đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Địa chỉ nhận hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Ngày mua hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Hành động</th>
                </tr>
            </thead>
            <tbody id="table_body">
                @foreach ($order as $item)
                    <tr>
                        <td style="text-align: center; align-items: center" scope="row">{{ $item->order_id }}</td>
                        <td style="text-align: center; align-items: center">{{ Auth::user()->user_name }}</td>
                        @if ($item->order_status === 1)
                            <td style="text-align: center; align-items: center">Chờ xác nhận</td>
                        @elseif($item->order_status === 2)
                            <td style="text-align: center; align-items: center">Đã xác nhận</td>
                        @elseif($item->order_status === 3)
                            <td style="text-align: center; align-items: center">Chờ lấy hàng</td>
                        @elseif($item->order_status === 4)
                            <td style="text-align: center; align-items: center">Đang giao hàng </td>
                        @elseif($item->order_status === 5)
                            <td style="text-align: center; align-items: center">Đã hoàn thành </td>
                        @endif
                        <td style="text-align: center; align-items: center">
                            {{ $item->name_xaphuong }}, {{ $item->name_quanhuyen }}, {{ $item->name_city }}
                        </td>
                        <td style="text-align: center; align-items: center">
                            {{ DATE_FORMAT($item->created_at, 'H:i:s - d-m-Y') }}
                        </td>
                        <td style="text-align: center; align-items: center; ">
                            <a href="{{ URL::to('/show-detail-order-history/' . $item->order_id) }}">
                                <i style="cursor: pointer;" class="fa fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
