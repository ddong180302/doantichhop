<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\Users;
use App\Models\XaPhuongThiTran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
    public function AuthLogin()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $user_role = Auth::user()->user_role;
            if ($user && $user_role === "QUANTRIVIEN") {
                return Redirect::to('/dasboard');
            } else {
                return Redirect::to('login')->send();
            }
        } else {
            return Redirect::to('login')->send();
        }
    }

    public function checkEmailExists($email)
    {
        $existingUser = Users::where('user_email', $email)->first();

        if ($existingUser) {
            // Email đã tồn tại
            return false;
        } else {
            // Email không tồn tại
            return true;
        }
    }

    public function show_add_user()
    {
        $this->AuthLogin();
        return view('admin.user.add_user');
    }

    public function get_all_user()
    {
        $this->AuthLogin();
        $user = Users::orderByDesc('user_id')->paginate(4);
        return view('admin.user.all_users', compact('user'));
    }

    public function add_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email|max:255',
            'user_name' => 'required',
            'user_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Bạn cần phải nhập đầy đủ thông tin để đăng ký!');
        }
        try {
            $data = $request->all();
            // Kiểm tra tính duy nhất của địa chỉ email
            if (!$this->checkEmailExists($data['user_email'])) {
                return redirect()->back()->with('message', 'Địa chỉ email đã tồn tại. Vui lòng sử dụng địa chỉ email khác.');
            } else {
                //$user_token = strtoupper(Str::random(6));
                $user_password = strtoupper(Str::random(10));
                // Create a new user
                $user = new Users();
                $user->user_name = $data['user_name'];
                $user->user_email = $data['user_email'];
                $user->user_phone = $data['user_phone'];
                $user->user_role = $data['user_role'];
                $user->user_token = "";
                $user->user_status = 1;
                $user->user_password = Hash::make($user_password);
                $user->save();
                Mail::send('admin.user.active_account', compact('user', 'user_password'), function ($email) use ($user) {
                    $email->subject('Đồ án tích hợp nhóm 4 - Xác Nhận tài khoản');
                    $email->to($user->user_email, $user->user_name);
                });
                $user_id = $user->user_id;
                // Redirect to the login page with a success message
                return redirect('/active-email/' . $user_id)->with('user_id', $user_id)->with('message', 'Tạo tài khoản người dùng thành công!');
            }
        } catch (\Exception $e) {
            //Handle the exception and return an error message
            return view('register')->with('error', 'Tạo tài khoản người dùng thất bại. Vui lòng thử lại sau.');
        }
    }

    public function unactive_user($user_id)
    {
        $this->AuthLogin();
        Users::where('user_id', $user_id)->update(['user_status' => 0]);
        return Redirect::to('get-all-user')->with('message', 'Không kích hoạt người dùng thành công');
    }

    public function active_user($user_id)
    {
        $this->AuthLogin();
        Users::where('user_id', $user_id)->update(['user_status' => 1]);
        return Redirect::to('get-all-user')->with('message', 'Kích hoạt người dùng thành công');
    }

    public function edit_user($user_id)
    {
        $this->AuthLogin();
        $edit_user = Users::where('user_id', $user_id)->get();
        $manager_user = view('admin.user.edit_user')->with('edit_user', $edit_user);
        return view('admin_layout')->with('admin.user.edit_user', $manager_user);
        return Redirect::to('get-all-user')->with('message', 'Chỉnh sửa thông tin thành công');
    }

    public function delete_user($user_id)
    {
        $this->AuthLogin();
        Users::where('user_id', $user_id)->delete();
        return Redirect::to('get-all-user')->with('message', 'Xóa người dùng thành công');
    }


    public function update_user(Request $request, $user_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_name'] = $request->user_name;
        $data['user_name'] = $request->user_name;
        $data['user_name'] = $request->user_name;
        $data['user_status'] = $request->user_status;
        Users::where('user_id', $user_id)->update($data);
        Session::put('message', 'Cập nhật người dùng thành công');
        return Redirect::to('get-all-user');
    }

    public function show_user_profile($user_id)
    {
        $user =  Users::where('user_id', $user_id)->first();
        $city_province = TinhThanhPho::select('matp', 'name_city', 'type')->get();
        return view('pages.user.profile')->with('user', $user)->with('city_province', $city_province);
    }

    public function getDistricts($matp)
    {

        $districts = QuanHuyen::where('matp', $matp)->get();

        return redirect()->back()->with('districts', $districts);
    }

    public function getWards($maqh)
    {

        $wards = XaPhuongThiTran::where('maqh', $maqh)->get();

        return redirect()->back()->with('wards', $wards);
    }

    public function add_avatar(Request $request, $user_id)
    {

        $user =  Users::where('user_id', $user_id)->first();
        if ($user && $request->hasFile('user_image')) {
            $get_image = $request->file('user_image');;
            if ($get_image) {
                $get_name_image = $get_image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
                $get_image->move('public/uploads/user', $new_image);
                $user->user_avatar = $new_image;
                $user->save();
                return redirect()->back()->with('message', 'Thêm ảnh đại diện thành công');
            }
        } else {
            return redirect()->back()->with('message', 'Bạn cần phải tải hình ảnh');
        }
    }
}
