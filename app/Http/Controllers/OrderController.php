<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\QuanHuyen;
use App\Models\TinhThanhPho;
use App\Models\Users;
use App\Models\XaPhuongThiTran;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;




class OrderController extends Controller
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
    public function show_order($user_id)
    {
        $cart = Cart::where('user_id', $user_id)->first();
        $cart_id = $cart->cart_id;
        $order = CartDetail::where('cart_id', $cart_id)->get();
        $total_price = 0;
        foreach ($order as $item) {
            $total_price += $item->quantity * $item->price;
        }
        $count_product = CartDetail::where('cart_id', $cart_id)->count();
        $user = Users::where('user_id', $user_id)->first();
        $city = TinhThanhPho::where('matp', $user->matp)->first();
        $city_province = TinhThanhPho::select('matp', 'name_city', 'type')->get();
        $province = QuanHuyen::where('maqh', $user->maqh)->first();
        $wards = XaPhuongThiTran::where('xaid', $user->xaid)->first();
        $payment = Payment::select('payment_id', 'payment_method', 'payment_status')->first();
        return view('pages.order.show_order', compact('order', 'city_province', 'count_product', 'city', 'province', 'wards', 'total_price', 'payment'));
    }

    public function show_verify_email_order($user_id)
    {
        $user = Users::where('user_id', $user_id)->first();
        $cart = Cart::where('user_id', $user_id)->first();
        $cart_detail = CartDetail::where('cart_id', $cart->cart_id)->get();
        $total_price = 0;
        foreach ($cart_detail as $item) {
            $total_price += $item->quantity * $item->price;
        }
        $city = TinhThanhPho::where('matp', $user->matp)->first();
        $province = QuanHuyen::where('maqh', $user->maqh)->first();
        $wards = XaPhuongThiTran::where('xaid', $user->xaid)->first();
        $user_token = strtoupper(Str::random(10));
        $user->user_token = $user_token;
        $user->update();
        Mail::send('pages.order.email_order', compact('user', 'cart_detail', 'city', 'province', 'wards', 'total_price'), function ($email) use ($user) {
            $email->subject('Đồ án tích hợp nhóm 2 - Xác Nhận tài khoản');
            $email->to($user->user_email, $user->user_name);
        });
        $user_id = $user->user_id;
        return redirect('/verify-email-order/' . $user_id)->with('user_id', $user_id)->with('message', 'Vui lòng kiểm tra gmail của bạn để xác thực đơn hàng!');
    }

    public function verify_email_order($user_id)
    {
        return view('pages.order.verify_email_order')->with('user_id', $user_id);
    }

    public function verify_order(Request $request, $user_id)
    {
        $user = Users::where('user_id',  $user_id)->first();
        $cart = Cart::where('user_id', $user->user_id)->first();
        $cart_detail = CartDetail::where('cart_id', $cart->cart_id)->get();
        $city = TinhThanhPho::where('matp', $user->matp)->first();
        $province = QuanHuyen::where('maqh', $user->maqh)->first();
        $wards = XaPhuongThiTran::where('xaid', $user->xaid)->first();

        $data = $request->all();
        $user_token = $data['user_token'];
        if ($user->user_token === $user_token) {
            $order = new Order();
            $order->user_id = $user_id;
            $order->order_status = 1;
            $order->xaid = $wards->xaid;
            $order->maqh = $province->maqh;
            $order->matp = $city->matp;
            $order->save();

            $order_id = $order->order_id;
            foreach ($cart_detail as $item) {
                $order_detail = new Order_Detail();

                $order_detail->order_id = $order_id;
                $order_detail->product_id = $item->product_id;
                $order_detail->product_name = $item->name;
                $order_detail->product_price = $item->price;
                $order_detail->product_quantity = $item->quantity;
                $order_detail->product_image = $item->image;

                $order_detail->save();
            }

            foreach ($cart_detail as $item) {
                $product = Product::find($item->product_id);
                $product->product_quantity -= $item->quantity;
                $product->product_sold += $item->quantity;
                $product->save();
            }

            CartDetail::where('cart_id', $cart->cart_id)->delete();
            $user->update(['user_status' => 1, 'user_token' => null]);

            return redirect('/')->with('message', 'Xác nhận đơn hàng thành công, bạn có thể tiếp tục mua hàng!');
        } else {
            return redirect()->back()->with('message', 'Mã xác thực bạn gửi không hợp lệ, vui lòng nhập lại');
        }
    }


    //admin
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

    public function update_status_order(Request $request, $order_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['order_status'] = intval($request->order_status);
        Order::where('order_id', $order_id)->update($data);
        return redirect()->back()->with('message', 'Cập nhật trạng thái đơn hàng thành công');
    }
}
