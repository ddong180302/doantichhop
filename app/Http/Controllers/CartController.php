<?php

namespace App\Http\Controllers;

use App\Helper\CartHelper;
use App\Models\Category;
use App\Models\Product;
use App\Models\Users;
use App\Models\Cart;
use App\Models\CartDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class CartController extends Controller
{
    public function AuthLogin()
    {
        $user = Auth::user();
        if ($user) {
            return Redirect::to('/add-cart');
        } else {
            return Redirect::to('/login')->send();
        }
    }

    public function add_cart_detail($product_id, $user_id, $detail_quantity)
    {
        $this->AuthLogin();
        $product = Product::where('product_id', $product_id)->first();
        $user = Users::where('user_id', $user_id)->first();
        if ($product != null && $user != null) {
            $cart = Cart::where('user_id', $user_id)->first();
            if ($cart) {
                $cart_id = $cart->cart_id;
                // Lưu thông tin vào bảng "CartDetail"
                $cartdetail = CartDetail::where('cart_id', $cart_id)->where('product_id', $product_id)->first();
                if ($cartdetail) {
                    if ($cartdetail->quantity < $product->product_quantity) {
                        $cartdetail->quantity += $detail_quantity;
                        $cartdetail->update();
                        return redirect()->back()->with('message', 'Thêm sản phẩm thành công');
                    } else {
                        return redirect()->back()->with('message', 'Số lượng sản phẩm trong giỏ hàng đã vượt quá số lượng sản phẩm trong kho');
                    }
                } else {
                    $cartDetail = new CartDetail();
                    $cartDetail->cart_id = $cart_id;
                    $cartDetail->image = $product->product_image;
                    $cartDetail->name = $product->product_name;
                    $cartDetail->price = $product->product_price;
                    $cartDetail->product_id = $product_id;
                    $cartDetail->quantity += $detail_quantity;
                    $cartDetail->save();
                    return redirect()->back()->with('message', 'Thêm sản phẩm thành công');
                }
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->save();

                // Lấy cart_id
                $cart_id = $cart->cart_id;

                // Lưu thông tin vào bảng "CartDetail"
                $cartDetail = new CartDetail();
                $cartDetail->cart_id = $cart_id;
                $cartDetail->image = $product->product_image;
                $cartDetail->name = $product->product_name;
                $cartDetail->price = $product->product_price;
                $cartDetail->product_id = $product_id;
                $cartDetail->quantity += $detail_quantity;
                $cartDetail->save();
                return redirect()->back()->with('message', 'Thêm sản phẩm thành công');
            }
        } else {
            return redirect()->back()->with('message', 'Thêm sản phẩm thất bại');
        }
    }

    public function add_cart($product_id, $user_id)
    {
        $this->AuthLogin();
        $product = Product::where('product_id', $product_id)->first();
        $user = Users::where('user_id', $user_id)->first();
        if ($product != null && $user != null) {
            $cart = Cart::where('user_id', $user_id)->first();
            if ($cart) {
                $cart->user_id = $user_id;
                $cart->update();
                $cart_id = $cart->cart_id;
                // Lưu thông tin vào bảng "CartDetail"
                $cartdetail = CartDetail::where('cart_id', $cart_id)->where('product_id', $product_id)->first();
                if ($cartdetail) {
                    if ($cartdetail->quantity < $product->product_quantity) {
                        $cartdetail->quantity += 1;
                        $cartdetail->update();
                        return Redirect::to('/')->with('message', 'Thêm sản phẩm thành công');
                    } else {
                        return Redirect::to('/')->with('message', 'Số lượng sản phẩm trong giỏ hàng đã vượt quá số lượng sản phẩm trong kho');
                    }
                } else {
                    $cartDetail = new CartDetail();
                    $cartDetail->cart_id = $cart_id;
                    $cartDetail->image = $product->product_image;
                    $cartDetail->name = $product->product_name;
                    $cartDetail->price = $product->product_price;
                    $cartDetail->product_id = $product_id;
                    $cartDetail->quantity += 1;
                    $cartDetail->save();
                    return Redirect::to('/')->with('message', 'Thêm sản phẩm thành công');
                }
            } else {
                $cart = new Cart();
                $cart->user_id = $user_id;
                $cart->save();

                // Lấy cart_id
                $cart_id = $cart->cart_id;

                // Lưu thông tin vào bảng "CartDetail"
                $cartDetail = new CartDetail();
                $cartDetail->cart_id = $cart_id;
                $cartDetail->image = $product->product_image;
                $cartDetail->name = $product->product_name;
                $cartDetail->price = $product->product_price;
                $cartDetail->product_id = $product_id;
                $cartDetail->quantity += 1;
                $cartDetail->save();
                return Redirect::to('/')->with('message', 'Thêm sản phẩm thành công');
            }
        } else {
            return Redirect::to('/')->with('message', 'Thêm sản phẩm thất bại');
        }
    }

    public function delete_item_cart($product_id, $user_id, $cart_id, $cart_detail_id)
    {
        $product = Product::where('product_id', $product_id)->first();
        $user = Users::where('user_id', $user_id)->first();
        $cart = Cart::where('cart_id', $cart_id)->first();
        $cart_detail = CartDetail::where('cart_detail_id', $cart_detail_id)->first();
        if ($user && $product && $cart_detail && $cart) {
            $cart_detail->delete();
            return redirect()->back()->with('message', 'Xóa sản phẩm thành công!');
        } else {
            return redirect()->back()->with('message', 'Xóa sản phẩm thất bại!');
        }
    }

    public function show_cart()
    {
        $this->AuthLogin();
        $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
        $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
        $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
        $total_price = 0;
        foreach ($cart as $item) {
            $total_price += $item->quantity * $item->product_price;
        }
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('cart', $cart)->with('count_product', $count_product)->with('total_price', $total_price);
    }

    public function update_cart_detail($cart_detail_id, $quantity)
    {
        $cart_detail = CartDetail::where('cart_detail_id', $cart_detail_id)->first();

        if ($cart_detail  && $quantity) {
            $cart_detail->quantity = $quantity;
            $cart_detail->update();
            return redirect()->back()->with('message', 'Cập nhật số lượng thành công!');
        } else {
            return redirect()->back()->with('message', 'Cập nhật số lượng thất bại!');
        }
    }
}
