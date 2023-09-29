<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CategoryProduct extends Controller
{
    //category admin
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

    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.category.add_category_product');
    }

    public function get_all_category_product()
    {
        $this->AuthLogin();
        $get_all_category_product = Category::paginate(2);
        $manager_category_product = view('admin.category.get_all_category_product')->with('get_all_category_product', $get_all_category_product);
        return view('admin_layout')->with('admin.category.get_all_category_product', $manager_category_product);
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $category = new Category();
        $category->category_name = $data['category_product_name'];
        $category->category_desc = $data['category_product_desc'];
        $category->category_status = $data['category_product_status'];
        $category->save();
        return Redirect::to('/add-category-product')->with('message', 'Thêm danh mục sản phẩm thành công');
    }

    public function unactive_category_product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id', $category_product_id)->update(['category_status' => 0]);
        Session::put('message', 'Không kích hoạt danh mục sản phẩm thành công');
        return Redirect::to('/get-all-category-product');
    }

    public function active_category_product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id', $category_product_id)->update(['category_status' => 1]);
        return Redirect::to('/get-all-category-product')->with('message', 'Kích hoạt danh mục sản phẩm thành công');
    }

    public function edit_category_product($category_product_id)
    {
        $this->AuthLogin();
        $edit_category_product = Category::where('category_id', $category_product_id)->get();
        $manager_category_product = view('admin.category.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.category.edit_category_product', $manager_category_product);
    }

    public function delete_category_product($category_product_id)
    {
        $this->AuthLogin();
        Category::where('category_id', $category_product_id)->delete();
        return Redirect::to('/get-all-category-product')->with('message', 'Xóa danh mục sản phẩm thành công');
    }

    public function update_category_product($category_product_id)
    {
        $this->AuthLogin();
        $data = array();
        Category::where('category_id', $category_product_id)->update($data);
        return Redirect::to('get-all-category-product')->with('message', 'Cập nhật danh mục sản phẩm thành công');
    }

    //end category admin
    public function show_category_home($category_id)
    {

        if (Auth::user()) {
            $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
            $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->quantity * $item->product_price;
            }

            $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $category_name = Category::where('category_id', $category_id)->first();
            $category_by_id = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->get();
            return view('pages.category.show_category')->with('category', $cate_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name)->with('cart', $cart)->with('count_product', $count_product)->with('total_price', $total_price);
        } else {
            $cate_product = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $category_name = Category::where('category_id', $category_id)->first();
            $category_by_id = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->where('tbl_product.category_id', $category_id)->get();
            return view('pages.category.show_category')->with('category', $cate_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
        }
    }
}
