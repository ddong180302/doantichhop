<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Shipping;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

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

    public function view_order($orderId)
    {
        $this->AuthLogin();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order_details.order_id', '=', 'tbl_order.order_id')->where('tbl_order.order_id', $orderId)->get();
        $manager_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id);
        return view('admin_layout')->with('admin.view_order', $manager_order_by_id);
    }
    public function login_checkout()
    {
        $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
        return view('pages.checkout.login_checkout')->with('category', $cate_product);
    }

    public function checkout()
    {
        $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product);
    }

    public function save_checkout_customer(Request $request)
    {
        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_notes'] = $request->shipping_notes;
        $data['shipping_phone'] = $request->shipping_phone;
        $data['shipping_address'] = $request->shipping_address;

        $shipping_id = Shipping::insertGetId($data);

        Session::put('shipping_id', $shipping_id);
        Session::put('shipping_name', $request->shipping_name);
        return Redirect::to('/payment');
    }

    public function payment()
    {
        $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
        return view('pages.checkout.payment')->with('category', $cate_product);
    }

    public function logout_checkout(Request $request)
    {
        Session::flush();
        return Redirect::to('/login-checkout');
    }

    public function order_place(Request $request)
    {
        //insert payment method
        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);


        //insert order
        $order_data = array();
        $order_data['customer_id'] = Session::get('customer_id');
        $order_data['shipping_id'] = Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total();
        $order_data['order_status'] = 'Đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);

        //insert order_details
        $content = Cart::content();
        foreach ($content as $v_content) {
            $order_d_data = array();
            $order_d_data['order_id'] =  $order_id;
            $order_d_data['product_id'] = $v_content->id;
            $order_d_data['product_name'] = $v_content->name;
            $order_d_data['product_price'] = $v_content->price;
            $order_d_data['product_sales_quantity'] = $v_content->qty;
            DB::table('tbl_order_details')->insert($order_d_data);
        }

        if ($data['payment_method'] == 1) {
            echo 'Thanh toán bằng thẻ ATM';
        } elseif ($data['payment_method'] == 2) {
            Cart::destroy();
            $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderByDesc('category_id')->get();
            return view('pages.checkout.handcash')->with('category', $cate_product);
        } else {
            echo 'Thanh toán bằng thẻ ghi nợ';
        }
    }

    public function manage_order()
    {
        $this->AuthLogin();
        $get_all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name')->orderByDesc('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('get_all_order', $get_all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }
}
