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
                    <th scope="col" style="text-align: center; align-items: center">Mã đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Tên người mua</th>
                    <th scope="col" style="text-align: center; align-items: center">Trạng thái đơn hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Địa chỉ nhận hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Ngày mua hàng</th>
                    <th scope="col" style="text-align: center; align-items: center">Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $item)
                    <tr>
                        <td style="text-align: center; align-items: center" scope="row">{{ $item->order_id }}</td>
                        <td style="text-align: center; align-items: center">{{ Auth::user()->user_name }}</td>
                        <td style="text-align: center; align-items: center">{{ $item->order_status }}</td>
                        <td style="text-align: center; align-items: center">{{ $item->order_status }}</td>
                        <td style="text-align: center; align-items: center">
                            {{ DATE_FORMAT($item->created_at, 'H:i:s - d-m-Y') }}</td>
                        <td style="text-align: center; align-items: center">
                            <i class="fa fa-eye"></i>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
