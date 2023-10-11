<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\Users;
use App\Models\XaPhuongThiTran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
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
                    $email->subject('Đồ án tích hợp nhóm 2 - Xác Nhận tài khoản');
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
        $edit_user = Users::where('user_id', $user_id)->first();
        return view('admin.user.edit_user')->with('edit_user', $edit_user);
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
        $data['user_phone'] = $request->user_phone;
        $data['user_role'] = $request->user_role;
        $data['user_status'] = $request->user_status;
        Users::where('user_id', $user_id)->update($data);
        return Redirect::to('get-all-user')->with('message', 'Cập nhật người dùng thành công');
    }

    public function show_user_profile($user_id)
    {
        $user =  Users::where('user_id', $user_id)->first();
        $city = TinhThanhPho::where('matp', $user->matp)->first();
        $province = QuanHuyen::where('maqh', $user->maqh)->first();
        $wards = XaPhuongThiTran::where('xaid', $user->xaid)->first();
        $city_province = TinhThanhPho::select('matp', 'name_city', 'type')->get();
        return view('pages.user.profile')->with('user', $user)->with('city_province', $city_province)->with('wards', $wards)->with('province', $province)->with('city', $city);
    }

    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = QuanHuyen::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>---Chọn quận huyện---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_quanhuyen . '</option>';
                }
            } else {
                $select_wards = XaPhuongThiTran::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>---Chọn xã phường---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xaphuong . '</option>';
                }
            }
            echo $output;
        }
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

    public function update_profile(Request $request, $user_id)
    {
        $data = array();
        $data['user_name'] = $request->user_name;
        $data['user_phone'] = $request->user_phone;
        $data['matp'] = intval($request->city);
        $data['maqh'] = intval($request->province);
        $data['xaid'] = intval($request->wards);
        $user =  Users::where('user_id', $user_id)->first();
        if ($user) {
            $user->update($data);;
            return redirect()->back()->with('message', 'Cập nhật thông tin thành công!');
        } else {
            return redirect()->back()->with('message', 'Cập nhật thông tin thất bại!');
        }
    }

    public function show_order_history($user_id)
    {
        $order = Order::where('user_id', $user_id)
            ->join('tbl_xaphuongthitran', 'tbl_xaphuongthitran.xaid', '=', 'tbl_order.xaid')
            ->join('tbl_quanhuyen', 'tbl_quanhuyen.maqh', '=', 'tbl_order.maqh')
            ->join('tbl_tinhthanhpho', 'tbl_tinhthanhpho.matp', '=', 'tbl_order.matp')
            ->select('tbl_order.*', 'tbl_xaphuongthitran.name_xaphuong', 'tbl_quanhuyen.name_quanhuyen', 'tbl_tinhthanhpho.name_city')
            ->get();

        return view('pages.user.order_history', compact('order'));
    }

    public function show_change_password_user($user_id)
    {
        $user = Users::where('user_id', $user_id)->first();
        return view('pages.user.change_password', compact('user'));
    }


    public function change_password_user(Request $request, $user_id)
    {
        $user = Users::where('user_id', $user_id)->first();

        if (Hash::check($request->user_password, $user->user_password)) {
            $user->update(['user_password' => Hash::make($request->user_new_password)]);
            return Redirect::to('/login')->with('message', 'Đổi mật khẩu thành công, bạn có thể đăng nhập');
        } else {
            return redirect()->back()->with('message', 'Đổi mật khẩu thất bại, mật khẩu cũ của bạn không đúng!');
        }
    }

    public function search_users(Request $request)
    {
        $key_users = $request->key_users;
        $search_users = Users::where('user_name', 'like', '%' . $key_users . '%')->paginate(4);
        return view('admin.user.search_users')->with('message', 'Các sản phẩm bạn muốn tìm')->with('search_users', $search_users);
    }


    public function show_detail_order_history($order_id)
    {
        $order_detail = Order_Detail::where('order_id', $order_id)->get();
        return view('pages.user.show_order_history_detail', compact('order_detail'));
    }
}
