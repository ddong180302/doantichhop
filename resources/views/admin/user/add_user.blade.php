@extends('admin_layout')
@section('admin_content')
    <div class="row">
        <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                    Thêm người dùng
                </header>
                @if (session('message'))
                    <script>
                        toastify().success('{{ session('message') }}');
                    </script>
                @endif
                <div class="panel-body">
                    <div class="position-center">
                        <form role="form" action="{{ URL::to('add-user') }}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label>Tên người dùng</label>
                                <input type="text" name="user_name" class="form-control"
                                    placeholder="Nhập tên người dùng" required>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="user_email" class="form-control" placeholder="Nhập email"
                                    required>
                            </div>
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="user_phone" class="form-control"
                                    placeholder="Nhập số điện thoại" required>
                            </div>
                            <div class="form-group">
                                <label>Quyền tài khoản</label>
                                <select name="user_role" class="form-control input-sm m-bot15">
                                    <option value="QUANTRIVIEN">Quản trị viên</option>
                                    <option value="NGUOIDUNG">Người dùng</option>
                                </select>
                            </div>
                            <button type="submit" name="add_user" class="btn btn-info">Thêm Người Dùng</button>
                        </form>
                    </div>

                </div>
            </section>
        </div>
    @endsection
