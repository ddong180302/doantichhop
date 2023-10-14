@extends('admin_layout')
@section('admin_content')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div style="padding: 20px">
        <a href="{{ URL::to('/manage-order') }}">
            <button class="btn btn-success">Quay lại</button>
        </a>
    </div>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin khách hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="text-align: center; align-items: center">Tên khách hàng</th>
                            <th style="text-align: center; align-items: center">Số điện thoại</th>
                            <th style="text-align: center; align-items: center">Email đặt hàng</th>
                            <th style="text-align: center; align-items: center">Địa chỉ nhận hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="text-align: center; align-items: center">{{ $user->user_name }}</td>
                            <td style="text-align: center; align-items: center">{{ $user->user_phone }}</td>
                            <td style="text-align: center; align-items: center">{{ $user->user_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <br>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chuyển đổi trạng thái đơn hàng
            </div>
            <form action="{{ URL::to('/update-status-order/' . $order->order_id) }}" method="POST">
                {{ csrf_field() }}
                <div style="display: flex; flex-direction: row; justify-content: center; gap: 100px; padding: 40px 0">
                    <div>Trạng Thái đơn hàng</div>
                    <div>
                        <select style="width: 300px; padding: 10px; border: 1px solid #333; outline: none"
                            name="order_status" id="">
                            <option value="{{ $order->order_status }}">
                                @if ($order->order_status === 1)
                                    Chưa xử lý
                                @elseif($order->order_status === 2)
                                    Đang xử lý
                                @elseif($order->order_status === 3)
                                    Đang đóng gói
                                @elseif($order->order_status === 4)
                                    Đang vận chuyển
                                @elseif($order->order_status === 5)
                                    Hoàn thành
                                @endif
                            </option>
                            @if ($order->order_status !== 2 && $order->order_status < 2)
                                <option value="2">Đang xử lý</option>
                            @endif
                            @if ($order->order_status !== 3 && $order->order_status < 3)
                                <option value="3">Đang đóng gói</option>
                            @endif
                            @if ($order->order_status !== 4 && $order->order_status < 4)
                                <option value="4">Đang vận chuyển</option>
                            @endif
                            @if ($order->order_status !== 5 && $order->order_status < 5)
                                <option value="5">Hoàn thành</option>
                            @endif
                        </select>
                    </div>
                    <div>
                        <button class="btn btn-primary" type="submit">Xác Nhận</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="text-align: center; align-items: center">
                                Số thứ tự
                            </th>
                            <th style="text-align: center; align-items: center">
                                Tên sản phẩm
                            </th>
                            <th style="text-align: center; align-items: center">
                                Số lượng
                            </th>
                            <th style="text-align: center; align-items: center">
                                Giá sản phẩm
                            </th>
                            <th style="text-align: center; align-items: center">
                                Tổng tiền
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                            $total = 0;
                        @endphp
                        @foreach ($order_detail as $key => $details)
                            @php
                                $i++;
                                $subtotal = $details->product_price * $details->product_quantity;
                                $total += $subtotal;
                            @endphp
                            <tr class="color_qty_{{ $details->product_id }}">
                                <td style="text-align: center; align-items: center">
                                    {{ $i }}
                                </td>
                                <td style="text-align: center; align-items: center">
                                    {{ $details->product_name }}
                                </td>
                                <td style="text-align: center; align-items: center">
                                    {{ $details->product_quantity }}
                                </td>
                                <td style="text-align: center; align-items: center">
                                    {{ number_format($details->product_price, 0, ',', '.') }} đ
                                </td>
                                <td style="text-align: center; align-items: center">
                                    {{ number_format($subtotal, 0, ',', '.') }} đ
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
