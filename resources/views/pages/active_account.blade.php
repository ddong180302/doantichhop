<div style="width:600px; margin: 0 auto">
    <div style="text-align: center">
        <h2>Xin chào {{ $user->user_name }}</h2>
        <p>Bạn đã đăng ký tài khoản tại hệ thống của chúng tôi</p>
        <p>
        <h2>{{ $user->user_token }}</h2> là mã kích hoạt. Để có thể sử dụng được bạn vui lòng nhập mã này để kích hoạt
        tài
        khoản</p>
        {{-- <p>
            <a href="{{ route('user.actived', ['user' => $user->user_id, 'token' => $user->user_token]) }}"
                style="display:inline-block; background: green; color: #fff; padding: 7px 25px; font-weight: bold">Kích
                hoạt tài
                khoản</a>
        </p> --}}
    </div>
</div>
