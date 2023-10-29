@extends('admin_layout')
@section('admin_content')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
            </div>
            <div class="row w3-res-tb">

            </div>
            <div class="table-responsive">
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th style="text-align: center; align-items: center">Thứ tự</th>
                            <th style="text-align: center; align-items: center">Mã đơn hàng</th>
                            <th style="text-align: center; align-items: center">Người đặt hàng</th>
                            <th style="text-align: center; align-items: center">Ngày tháng đặt hàng</th>
                            <th style="text-align: center; align-items: center">Trạng thái đơn hàng</th>
                            <th style="text-align: center; align-items: center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($get_all_order as $key => $ord)
                            @php
                                $i++;
                                $user = $users[$key]->first(); // Lấy đối tượng Users đầu tiên từ collection
                            @endphp
                            <tr>
                                <td style="text-align: center; align-items: center">{{ $i }}</td>
                                <td style="text-align: center; align-items: center">{{ $ord->order_id }}</td>
                                <td style="text-align: center; align-items: center">
                                    @if ($user)
                                        {{ $user->user_name }}
                                    @else
                                        (User không tồn tại)
                                    @endif
                                </td>
                                <td style="text-align: center; align-items: center">{{ $ord->created_at }}</td>
                                <td style="text-align: center; align-items: center">
                                    @if ($ord->order_status === 1)
                                        Chưa xử lý
                                    @elseif($ord->order_status === 2)
                                        Đang xử lý
                                    @elseif($ord->order_status === 3)
                                        Đang đóng gói
                                    @elseif($ord->order_status === 4)
                                        Đang vận chuyển
                                    @elseif($ord->order_status === 5)
                                        Hoàn thành
                                    @endif
                                </td>
                                <td style="text-align: center; align-items: center">
                                    <a href="{{ URL::to('/view-order/' . $ord->order_id) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-eye text-success text-active"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <footer class="panel-footer">
                <div class="row">
                    <div class="col-sm-7 text-right text-center-xs">
                        <ul class="pagination pagination-sm m-t-none m-b-none">
                            {{ $get_all_order->links() }}
                        </ul>
                    </div>
                </div>
            </footer>
        </div>
    </div>
@endsection
