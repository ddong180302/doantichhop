@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
        <div class="panel panel-default">
            <div class="panel-heading">
                Liệt kê users
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
                            <th>Mã người dùng</th>
                            <th>Tên user</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($user as $key => $user)
                            <tr>
                                <td>{{ $user->user_id }}</td>
                                <td>{{ $user->user_name }}</td>
                                <td>{{ $user->user_email }}</td>
                                <td>{{ $user->user_phone }}</td>
                                <td>
                                    <span class="text-ellipsis">
                                        <?php
                                                    if($user->user_status==1){
                                                ?>
                                        <a href="{{ URL::to('/unactive-user/' . $user->user_id) }}">
                                            <span> Hiển thị</span></a>
                                        <?php
                                                    }else{
                                                        ?>
                                        <a href="{{ URL::to('/active-user/' . $user->user_id) }}">
                                            <span>Ẩn</span></a>
                                        <?php
                                                    }
                                            ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ URL::to('/edit-user/' . $user->user_id) }}" class="active styling-edit"
                                        ui-toggle-class="">
                                        <i class="fa fa-pencil-square-o text-success text-active"></i>
                                    </a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này không?')"
                                        href="{{ URL::to('/delete-user/' . $user->user_id) }}" class="active styling-delete"
                                        ui-toggle-class="">
                                        <i class="fa fa-times text-danger text"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
