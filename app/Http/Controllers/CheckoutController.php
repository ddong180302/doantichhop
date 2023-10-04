<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $user = Auth::user();
        if ($user) {
            return Redirect::to('dasboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function view_order($order_id)
    {
        $this->AuthLogin();
        $order = Order::where('order_id', $order_id)->first();
        $user = Users::where('user_id', $order->user_id)->first();
        $order_detail = Order_Detail::where('order_id', $order_id)->get();

        return view('admin.order.view_order', compact('order', 'user', 'order_detail'));
    }

    public function manage_order()
    {
        $this->AuthLogin();
        $get_all_order = Order::paginate(5);
        $users = [];
        foreach ($get_all_order as $order) {
            $user = Users::where('user_id', $order->user_id)->get();
            $users[] = $user;
        }
        return view('admin.order.manage_order', compact('get_all_order', 'users'));
    }
}
