@extends('users')
@section('user')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif

    <div class="row profile-layout">
        <div class="change-password">
            <form id="change_password" action="{{ URL::to('/change-password-user/' . Auth::user()->user_id) }}" method="POST">
                {{ csrf_field() }}
                <div class="title">
                    <h3>Thay đổi mật khẩu</h3>
                </div>
                <div class="change-title">
                    <div class="title-info">
                        <label class="label">Tên đăng nhập:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->user_name }}" disabled>
                    </div>
                </div>

                <div class="change-title">
                    <div class="title-info">
                        <label class="label">Email đăng nhập:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->user_email }}" disabled>
                    </div>
                </div>

                <div class="change-title">
                    <div class="title-info">
                        <label class="label">Nhập mật khẩu cũ:</label>
                    </div>
                    <div class="info-name">
                        <input id="passwordInput1" class="input" name="user_password" type="password" required>
                        <i id="togglePassword1" class="fa fa-eye show-password"></i>
                    </div>
                </div>
                <div class="change-title">
                    <div class="title-info">
                        <label class="label">Nhập mật khẩu mới:</label>
                    </div>
                    <div class="info-name">
                        <input id="passwordInput2" class="input" name="user_new_password" type="password" required>
                        <i id="togglePassword2" class="fa fa-eye show-password"></i>
                    </div>
                </div>
                <div class="change-title">
                    <div class="title-info">
                        <label class="label">Xác thực mật khẩu mới:</label>
                    </div>
                    <div class="info-name">
                        <input id="passwordInput3" class="input" type="password" required>
                        <i id="togglePassword3" class="fa fa-eye show-password"></i>
                    </div>
                </div>
                <div class="info-action"
                    style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; margin: 30px 0">
                    <div class="title-info">
                    </div>
                    <div class="info-name">
                        <input id="changePasswordButton" class="btn btn-primary" type="submit" value="Đổi mật khẩu" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
