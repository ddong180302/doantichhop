<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function AuthLogin()
    {

        $user_id = Auth::id();
        if ($user_id) {
            return Redirect::to('/');
        } else {
            return Redirect::to('login')->send();
        }
    }
    public function register()
    {
        return view('register');
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

    public function register_auth(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_email' => 'required|email|max:255',
            'user_password' => 'required|min:6',
            'user_name' => 'required',
            'user_phone' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Bạn cần phải nhập đầy đủ thông tin để đăng ký!');
        }
        try {
            $user_token = strtoupper(Str::random(10));
            $data = $request->all();
            // Kiểm tra tính duy nhất của địa chỉ email
            if (!$this->checkEmailExists($data['user_email'])) {
                return redirect()->back()->with('message', 'Địa chỉ email đã tồn tại. Vui lòng sử dụng địa chỉ email khác.');
            } else {
                // Create a new user
                $user = new Users();
                $user->user_name = $data['user_name'];
                $user->user_email = $data['user_email'];
                $user->user_phone = $data['user_phone'];
                $user->user_token = $user_token;
                $user->user_status = 0;
                $user->user_password = Hash::make($data['user_password']);
                $user->user_role = "NGUOIDUNG";
                $user->save();
                Mail::send('pages.active_account', compact('user'), function ($email) use ($user) {
                    $email->subject('Đồ án tích hợp nhóm 2 - Xác Nhận tài khoản');
                    $email->to($user->user_email, $user->user_name);
                });
                $user_id = $user->user_id;
                // Redirect to the login page with a success message
                return redirect('/active-email/' . $user_id)->with('user_id', $user_id)->with('message', 'Đăng ký thành công!');
            }
        } catch (\Exception $e) {
            //Handle the exception and return an error message
            return view('register')->with('error', 'Đăng ký thất bại. Vui lòng thử lại sau.');
        }
    }

    public function active_email($user_id)
    {
        return view('pages.active_email')->with('user_id', $user_id);
    }

    public function actived(Request $request, $user_id)
    {
        $user = Users::where('user_id',  $user_id)->first();
        $data = $request->all();
        $user_token = $data['user_token'];
        if ($user->user_token === $user_token) {
            $user->update(['user_status' => 1, 'user_token' => null]);
            return redirect('/login')->with('message', 'Xác nhận tài khoản thành công, bạn có thể đăng nhập');
        } else {
            return redirect('/register')->with('error', 'Mã xác nhận bạn gửi không hợp lệ');
        }
    }

    public function validation(Request $request)
    {
        return $this->validate($request, [
            'user_name' => 'required|max:255',
            'user_email' => 'required|email|max:255',
            'user_phone' => 'required|max:255',
            'user_password' => 'required|max:255',
        ]);
    }

    public function login()
    {
        return view('login');
    }

    public function login_auth(Request $request)
    {
        $this->validate($request, [
            'user_email' => 'required|email|max:255',
            'user_password' => 'required|max:255',
        ]);

        if (Auth::attempt(['user_email' => $request->user_email, 'user_password' => $request->user_password])) {
            // Đăng nhập thành công
            $user = Users::where('user_email', $request->user_email)->first();
            if ($user && $user->user_status === 0) {
                $user_id = $user->user_id;
                return redirect('/login')->with('message', 'Đăng nhập thất bại bạn cần phải <a href="' . URL::to('/active-email/' . $user_id) . '">xác thực tài khoản</a>!');
            }
            return redirect('/')->with('message', 'Đăng nhập thành công!');
        } else {
            // Đăng nhập thất bại
            return redirect('/login')->with('message', 'Đăng nhập thất bại!');
        }
    }
    public function logout_auth()
    {
        $this->AuthLogin();
        Auth::logout();
        return Redirect::to('/login')->with('message', 'Đăng xuất thành công!');
    }


    public function forgot()
    {
        return view('pages.forgot');
    }

    public function forgot_email(Request $request)
    {
        $user_token = strtoupper(Str::random(10));
        // Kiểm tra tính duy nhất của địa chỉ email
        if (!$this->checkEmailExists($request->user_email)) {
            $user = Users::where('user_email', $request->user_email)->first();
            if ($user) {
                $user->update(['user_token' => $user_token]);
                Mail::send('pages.send_m_forgot_password', compact('user'), function ($email) use ($user) {
                    $email->subject('Đồ án tích hợp nhóm 2 - Xác Nhận tài khoản');
                    $email->to($user->user_email, $user->user_name);
                });
                $user_id = $user->user_id;
                return redirect('/show-forgot/' . $user_id)->with('user_id', $user_id)->with('message', 'Đã xác nhận địa chỉ email. Vui lòng check email để lấy mã.');
            }
        } else {
            return redirect()->back()->with('message', 'Địa chỉ email bạn nhập không tồn tại. Vui lòng sử dụng địa chỉ email mà bạn đã đăng ký.');
        }
    }

    public function show_forgot($user_id)
    {
        return view('pages.forgot_actived')->with('user_id', $user_id);
    }

    public function forgot_actived(Request $request, $user_id)
    {
        $user = Users::where('user_id',  $user_id)->first();
        $data = $request->all();
        $user_token = $data['user_token'];
        if ($user->user_token === $user_token) {
            $user->update(['user_status' => 1, 'user_token' => null]);
            return redirect('/show-change-password/' . $user_id)->with('user_id', $user_id)->with('message', 'Xác nhận tài khoản thành công, bạn có thể nhập mật khẩu mới');
        } else {
            return redirect()->back()->with('error', 'Mã xác nhận bạn gửi không hợp lệ');
        }
    }

    public function show_change_password($user_id)
    {
        return view('pages.change_password')->with('user_id', $user_id);
    }

    public function change_password(Request $request, $user_id)
    {
        $user = Users::where('user_id',  $user_id)->first();
        if ($user) {
            $user->update(['user_password' => Hash::make($request->user_password)]);
            return Redirect::to('/login')->with('message', 'Đổi mật khẩu thành công, bạn có thể đăng nhập');
        } else {
            return redirect()->back()->with('error', 'Đổi mật khẩu thất bại!');
        }
    }
}
