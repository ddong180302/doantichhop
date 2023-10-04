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
            <form id="viewForm">
                <div class="title">
                    <h3>Thông tin cá nhân</h3>
                </div>
                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Tên đăng nhập:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->user_name }}" disabled>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Email:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->user_email }}" disabled>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Số điện thoại:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->user_phone }}" disabled>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Địa chỉ:</label>
                    </div>
                    <div class="info-name">
                        <input class="input"
                            value="{{ $wards->name_xaphuong }}, {{ $province->name_quanhuyen }}, {{ $city->name_city }} "
                            disabled>
                    </div>
                </div>

                <div class="info-title">
                    <div class="title-info">
                        <label class="label">Ngày tạo:</label>
                    </div>
                    <div class="info-name">
                        <input class="input" value="{{ $user->created_at }}" disabled>
                    </div>
                </div>

                <div class="info-action"
                    style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; margin: 30px 0">
                    <div class="title-info">
                    </div>
                    <div class="info-name">
                        <button type="button" class="btn btn-success" id="editButton">Thay đổi thông tin</button>
                    </div>
                </div>
            </form>


            <form action="{{ URL::to('/update-profile/' . Auth::user()->user_id) }}" method="POST" id="editForm"
                style="display: none;">
                {{ csrf_field() }}
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
                <div class="title">
                    <h4>Địa chỉ</h4>
                </div>
                <div class="address">
                    <div class="address-name">
                        <div class="title-info">
                            <label class="label">Tỉnh Thành Phố</label>
                        </div>
                        <div class="info-name">
                            <select name="city" id="city" class="form-control choose city input-sm m-bot15">
                                @if ($city)
                                    <option value="{{ $city->matp }}">{{ $city->name_city }}</option>
                                @else
                                    <option value="">--Chọn tỉnh thành phố--</option>
                                @endif
                                @foreach ($city_province as $ci)
                                    <option value="{{ $ci->matp }}">{{ $ci->name_city }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="address-name">
                        <div class="title-info">
                            <label class="label">Quận Huyện</label>
                        </div>
                        <div class="info-name">
                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                @if ($province)
                                    <option value="{{ $province->maqh }}">{{ $province->name_quanhuyen }}</option>
                                @else
                                    <option value="">--Chọn quận huyện--</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="address-name">
                        <div class="title-info">
                            <label class="label">Xã Phường</label>
                        </div>
                        <div class="info-name">
                            <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                @if ($wards)
                                    <option value="{{ $wards->xaid }}">{{ $wards->name_xaphuong }}</option>
                                @else
                                    <option value="">--Chọn xã phường--</option>
                                @endif
                            </select>
                        </div>
                    </div>
                </div>
                <div class="info-action"
                    style="display: flex; flex-direction: row; justify-content: space-between; width: 100%; margin: 30px 0">
                    <div class="title-info">
                    </div>
                    <div class="info-name">
                        <button type="button" class="btn btn-primary" id="cancelButton">Hủy</button>
                        <input type="submit" class="btn btn-success" value="Lưu thay đổi">
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
