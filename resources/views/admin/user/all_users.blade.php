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
                Liệt kê users
            </div>
            <div class="row w3-res-tb" style="margin-bottom: 30px">
                <div class="col-sm-7 m-b-xs">
                </div>
                <div class="col-sm-5">
                    <form action="{{ URL::to('/search-users') }}" method="POST">
                        {{ csrf_field() }}
                        <div style="width: 100%; display: flex; flex-direction: row">
                            <div style="width: 80%">
                                <input type="text" name="key_users" class="input-sm form-control"
                                    placeholder="Tìm kiếm theo tên">
                            </div>
                            <div style="width: 20%;">
                                <button class="btn btn-sm btn-default" name="btn_user" type="button"
                                    onclick="searchUsers()"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="table-responsive" id="table-users-container">
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
                                        href="{{ URL::to('/delete-user/' . $user->user_id) }}"
                                        class="active styling-delete" ui-toggle-class="">
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
