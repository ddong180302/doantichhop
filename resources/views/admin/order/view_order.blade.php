@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Thông tin đăng nhập
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Tên khách hàng</th>
                            <th>Số điện thoại</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $user->user_name }}</td>
                            <td>{{ $user->user_phone }}</td>
                            <td>{{ $user->user_email }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê chi tiết đơn hàng
            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<span class="text-alert">' . $message . '</span>';
                    Session::put('message', null);
                }
                ?>

                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>
                                Số thứ tự
                            </th>
                            <th>Tên sản phẩm</th>
                            <th>Số lượng</th>
                            <th>Giá sản phẩm</th>
                            <th>Tổng tiền</th>
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
                                <td>{{ $i }}</td>
                                <td>{{ $details->product_name }}</td>
                                <td>{{ $details->product_quantity }}</td>
                                <td>{{ number_format($details->product_price, 0, ',', '.') }} đ</td>
                                <td>{{ number_format($subtotal, 0, ',', '.') }} đ</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="6">
                                @if ($order->order_status == 1)
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option id="{{ $order->order_id }}" selected value="1">Chưa xử lý
                                            </option>
                                            <option id="{{ $order->order_id }}" value="2">Đã xử lý-Đã giao hàng
                                            </option>
                                            <option id="{{ $order->order_id }}" value="3">Hủy đơn hàng-tạm giữ
                                            </option>
                                        </select>
                                    </form>
                                @elseif($order->order_status == 2)
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option id="{{ $order->order_id }}" value="1">Chưa xử lý</option>
                                            <option id="{{ $order->order_id }}" selected value="2">Đã xử lý-Đã giao
                                                hàng</option>
                                            <option id="{{ $order->order_id }}" value="3">Hủy đơn hàng-tạm giữ
                                            </option>
                                        </select>
                                    </form>
                                @else
                                    <form>
                                        @csrf
                                        <select class="form-control order_details">
                                            <option value="">----Chọn hình thức đơn hàng-----</option>
                                            <option id="{{ $order->order_id }}" value="1">Chưa xử lý</option>
                                            <option id="{{ $order->order_id }}" value="2">Đã xử lý-Đã giao hàng
                                            </option>
                                            <option id="{{ $order->order_id }}" selected value="3">Hủy đơn hàng-tạm
                                                giữ</option>
                                        </select>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
