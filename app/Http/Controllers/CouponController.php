<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class CouponController extends Controller
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

    public function unset_coupon()
    {
        $this->AuthLogin();
        $coupon = Session::get('coupon');
        if ($coupon == true) {

            Session::forget('coupon');
            return redirect()->back()->with('message', 'Xóa mã khuyến mãi thành công');
        }
    }
    public function insert_coupon()
    {
        $this->AuthLogin();
        return view('admin.coupon.insert_coupon');
    }
    public function delete_coupon($coupon_id)
    {
        $this->AuthLogin();
        $coupon = Coupon::find($coupon_id);
        $coupon->delete();
        Session::put('message', 'Xóa mã giảm giá thành công');
        return Redirect::to('list-coupon');
    }
    public function list_coupon()
    {
        $this->AuthLogin();
        $coupon = Coupon::orderby('coupon_id', 'DESC')->paginate(2);
        return view('admin.coupon.list_coupon')->with(compact('coupon'));
    }
    public function insert_coupon_code(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $coupon = new Coupon;
        $coupon->coupon_name = $data['coupon_name'];
        $coupon->coupon_number = $data['coupon_number'];
        $coupon->coupon_code = $data['coupon_code'];
        $coupon->coupon_time = $data['coupon_time'];
        $coupon->coupon_condition = $data['coupon_condition'];
        $coupon->save();
        return Redirect::to('insert-coupon')->with('message', 'Thêm mã giảm giá thành công');
    }
}
