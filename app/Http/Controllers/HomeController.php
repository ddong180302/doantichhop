<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::user()) {
            $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
            $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->quantity * $item->product_price;
            }

            $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $all_product = Product::where('product_status', '1')->orderByDesc('product_id')->paginate(12);
            return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product)->with('cart', $cart)->with('count_product', $count_product)->with('total_price', $total_price);
        } else {
            $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $all_product = Product::where('product_status', '1')->orderByDesc('product_id')->paginate(12);
            return view('pages.home')->with('category', $cate_product)->with('all_product', $all_product);
        }
    }

    public function search(Request $request)
    {

        if (Auth::user()) {
            $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
            $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->quantity * $item->product_price;
            }

            $keywords = $request->keywords_submit;
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderByDesc('category_id')->get();
            $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

            return view('pages.product.search')->with('category', $cate_product)->with('search_product', $search_product)->with('cart', $cart)->with('count_product', $count_product)->with('total_price', $total_price);
        } else {
            $keywords = $request->keywords_submit;
            $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderByDesc('category_id')->get();
            $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

            return view('pages.product.search')->with('category', $cate_product)->with('search_product', $search_product);
        }
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderByDesc('category_id')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        return view('pages.product.search')->with('category', $cate_product)->with('search_product', $search_product);
    }
}
