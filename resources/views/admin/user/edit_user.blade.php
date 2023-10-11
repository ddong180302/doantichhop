@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Cập nhật người dùng
                </header>
                @if (session('message'))
                    <script>
                        toastify().success('{{ session('message') }}');
                    </script>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('/update-user/' . $edit_user->user_id) }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input type="text" name="user_name" class="form-control"
                                    value="{{ $edit_user->user_name }}" placeholder="Nhập tên người dùng" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="user_email" value="{{ $edit_user->user_email }}"
                                    class="form-control" placeholder="Nhập email" disabled>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="user_phone" class="form-control"
                                    value="{{ $edit_user->user_phone }}" placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <label>Quyền tài khoản</label>
                                <select name="user_role" class="form-control input-sm m-bot15">
                                    @if ($edit_user->user_role === 'QUANTRIVIEN')
                                        <option value="QUANTRIVIEN">Quản trị viên</option>
                                        <option value="NGUOIDUNG">Người dùng</option>
                                    @else
                                        <option value="NGUOIDUNG">Người dùng</option>
                                        <option value="QUANTRIVIEN">Quản trị viên</option>
                                    @endif
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái người dùng</label>
                                <select name="user_status" class="form-control input-sm m-bot15">
                                    @if ($edit_user->user_status === 1)
                                        <option value="1">Hiển thị</option>
                                        <option value="0">Ẩn</option>
                                    @else
                                        <option value="0">Ẩn</option>
                                        <option value="1">Hiển thị</option>
                                    @endif
                                </select>
                            </div>
                            <button type="submit" name="add_user" class="btn btn-info">Cập Nhật Người Dùng</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    @endsection
