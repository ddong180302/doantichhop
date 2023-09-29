<div style="width:600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $user->user_name }}</h2>
        <p>Bạn đang lấy lại mật khẩu của tài khaorn này</p>
        <p>
        <h2>
            {{ $user->user_token }}
        </h2>
        là mã xác thực. Để thay đổi mật khẩu bạn vui lòng nhập mã này để xác thực tài khoản
        </p>
    </div>
</div>
