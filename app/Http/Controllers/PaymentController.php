<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Payment;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;


class PaymentController extends Controller
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

    public function show_add_payment()
    {
        $this->AuthLogin();
        return view('admin.payment.add_payment');
    }

    public function add_payment(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $payment = new Payment();
        $payment->payment_method = $data['payment_method'];
        $payment->payment_status = $data['payment_status'];
        $payment->save();
        return redirect()->back()->with('message', 'Thêm phương thức thanh toán thành công');
    }

    public function get_all_payment(Request $request)
    {
        $this->AuthLogin();
        $get_all_payment = Payment::paginate(4);
        return view('admin.payment.get_all_payment', compact('get_all_payment'));
    }

    public function unactive_payment($payment_id)
    {
        $this->AuthLogin();
        Payment::where('payment_id', $payment_id)->update(['payment_status' => 0]);
        return redirect()->back()->with('message', 'Không kích hoạt phương thức thanh toán thành công');
    }

    public function active_payment($payment_id)
    {
        $this->AuthLogin();
        Payment::where('payment_id', $payment_id)->update(['payment_status' => 1]);
        return redirect()->back()->with('message', 'Kích hoạt phương thức thanh toán thành công');
    }

    public function show_edit_payment($payment_id)
    {
        $this->AuthLogin();
        $edit_payment = Payment::where('payment_id', $payment_id)->first();
        return view('admin.payment.edit_payment')->with('edit_payment', $edit_payment);
    }

    public function edit_payment(Request $request, $payment_id)
    {
        $this->AuthLogin();
        $data = $request->all();
        $payment = Payment::where('payment_id', $payment_id)->first();
        $payment->payment_method = $data['payment_method'];
        $payment->save();
        return Redirect::to('/get-all-payment')->with('message', 'Cập nhật phương thức thanh toán thành công');
    }

    public function search_payment(Request $request)
    {
        $key_payment = $request->key_payment;
        $search_payment = Payment::where('payment_method', 'like', '%' . $key_payment . '%')->paginate(4);
        return view('admin.payment.search_payment')->with('message', 'Các phương thức thanh toán bạn muốn tìm')->with('search_payment', $search_payment);
    }
}
