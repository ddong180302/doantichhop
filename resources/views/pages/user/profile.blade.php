@extends('users')
@section('user')
    @if (session('message'))
        <script>
            toastify().success('{{ session('message') }}');
        </script>
    @endif

    <div class="row profile-layout">
        <div class="col-lg-5 col-sm-5 profile-avatar">
            <div class="title">
                <h3>Hình Ảnh</h3>
            </div>
            @if ($user->user_avatar == null)
                <div class="avatar">
                    <img id="previewImage" src="{{ URL::to('public/uploads/product/avataruser.png') }}" alt="">
                </div>
                <div class="avatar-action">
                    <form action="{{ URL::to('/add-avatar/' . Auth::user()->user_id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="action">
                            <input type="file" name="user_image" id="previewImg" accept="image/*" hidden
                                onchange="previewImage(event)">
                            <label for="previewImg" class="btn btn-primary"
                                style="outline: none; border: none; margin: 0 10px">
                                Thêm ảnh
                                <i class="fa fa-upload"></i>
                            </label>
                            <input class="btn btn-success" type="submit" value="Lưu thay đổi">
                        </div>
                    </form>
                </div>
            @else
                <div class="avatar">
                    <img id="previewImgUpdate" src="{{ asset('public/uploads/user/' . $user->user_avatar) }}"
                        alt="????">
                </div>
                <div class="avatar-action">
                    <form action="{{ URL::to('/add-avatar/' . Auth::user()->user_id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="action">
                            <input type="file" name="user_image" id="previewImg" accept="image/*" hidden
                                onchange="previewImageUpdate(event)">
                            <label for="previewImg" class="btn btn-primary"
                                style="outline: none; border: none; margin: 0 10px">
                                Thay đổi ảnh
                                <i class="fa fa-upload"></i>
                            </label>
                            <input class="btn btn-success" type="submit" value="Lưu thay đổi">
                        </div>
                    </form>
                </div>
            @endif
        </div>
        <div class="col-lg-7 col-sm-7 profile-info">
            <form action="">
                <div class="title">
                    <h3>Thông tin cá nhân</h3>
                </div>
                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Tên đăng nhập:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" type="text" value="{{ $user->user_name }}" name="user_name">
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Email:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" type="text" value="{{ $user->user_email }}" disabled>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Số điện thoại:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" type="text" value="{{ $user->user_phone }}" name="user_phone">
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Tỉnh Thành Phố:</label>
                    </div>
                    <div class="info-name">
                        <select name="cityProvince" id="city_province" class="form-control input-sm m-bot15">
                            @foreach ($city_province as $city)
                                <option value="{{ $city->matp }}">{{ $city->name_city }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Quận Huyện:</label>
                    </div>
                    <div class="info-name">
                        <select name="district" id="district" class="form-control input-sm m-bot15"></select>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Xã Phường:</label>
                    </div>
                    <div class="info-name">
                        <select name="wards" id="wards" class="form-control input-sm m-bot15"></select>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Ngày tạo:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" type="text" value="{{ $user->created_at }}" disabled>
                    </div>
                </div>

                <div class="info-action"
                    style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; margin: 30px 0">
                    <div class="title-info">
                    </div>
                    <div class="info-name">
                        <input type="submit" class="btn btn-success" name="" id=""
                            value="Lưu thay đổi">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
