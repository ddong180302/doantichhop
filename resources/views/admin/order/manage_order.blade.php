@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê đơn hàng
            </div>
            <div class="row w3-res-tb">

            </div>
            <div class="table-responsive">
                <?php
                $message = Session::get('message');
                if ($message) {
                    echo '<div class="text-alert">', $message, '</div>';
                    Session::put('message', null);
                }
                ?>
                <table class="table table-striped b-t b-light">
                    <thead>
                        <tr>
                            <th>Thứ tự</th>
                            <th>Mã đơn hàng</th>
                            <th>Người đặt hàng</th>
                            <th>Ngày tháng đặt hàng</th>
                            <th>Tình trạng đơn hàng</th>
                            <th>Hành động</th>
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
                                <td>{{ $i }}</td>
                                <td>{{ $ord->order_id }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $ord->created_at }}</td>
                                <td>
                                    @if ($ord->order_status == 1)
                                        Đơn hàng mới
                                    @else
                                        Đã xử lý
                                    @endif
                                </td>
                                <td>
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
