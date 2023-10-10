<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\Specifications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    //Admin page
    public function AuthLogin()
    {
        if (Auth::user()) {
            $user = Auth::user();
            $user_role = Auth::user()->user_role;
            if ($user && $user_role === "QUANTRIVIEN") {
                return Redirect::to('/dasboard');
            } else {
                return Redirect::to('/login')->send();
            }
        } else {
            return Redirect::to('/login')->send();
        }
    }

    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = Category::orderByDesc('category_id')->get();
        return view('admin.product.add_product')->with('cate_product', $cate_product);
    }

    public function get_all_product()
    {
        $this->AuthLogin();
        $get_all_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        return view('admin.product.get_all_product', compact('get_all_product'));
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $product = new Product();
        $product->product_name = $data['product_name'];
        $product->category_id = $data['category_id'];
        $product->product_desc = $data['product_desc'];
        $product->product_price = $data['product_price'];
        $product->product_status = $data['product_status'];
        $product->product_quantity = $data['product_quantity'];
        $product->product_sold = 0;
        $get_image = $request->file('product_image');
        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $product->product_image = $new_image;
            $product->save();
            return Redirect::to('/add-specifications')->with('message', 'Thêm sản phẩm thành công');
        } else {
            $data['product_image'] = '';
            $product->save();
            return Redirect::to('/add-specifications')->with('message', 'Thêm sản phẩm thành công');
        }
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        Product::where('product_id', $product_id)->update(['product_status' => 0]);
        return Redirect::to('/get-all-product')->with('message', 'Không kích hoạt sản phẩm thành công');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        Product::where('product_id', $product_id)->update(['product_status' => 1]);
        return Redirect::to('/get-all-product')->with('message', 'Kích hoạt sản phẩm thành công');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = Category::orderByDesc('category_id')->get();
        $edit_product = Product::where('product_id', $product_id)->get();
        $manager_product = view('admin.product.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
        return Redirect::to('/get-all-product')->with('message', 'Cập nhật sản phẩm thành công');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        Product::where('product_id', $product_id)->delete();
        return Redirect::to('/get-all-product')->with('message', 'Xóa sản phẩm thành công');
    }


    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            Product::where('product_id', $product_id)->update($data);
            return Redirect::to('/get-all-product')->with('message', 'Cập nhật sản phẩm thành công');
        } else {
            Product::where('product_id', $product_id)->update($data);
            return Redirect::to('/get-all-product')->with('message', 'Cập nhật sản phẩm thành công');
        }
    }

    public function detail_product(Request $request, $product_id)
    {
        if (Auth::user()) {
            $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
            $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->quantity * $item->product_price;
            }
            $gallery = Gallery::where('product_id', $product_id)->get();
            $category = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $detail_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->join('tbl_specifications', 'tbl_specifications.product_id', '=', 'tbl_product.product_id')->where('tbl_product.product_id', $product_id)->first();
            return view('pages.product.show_detail_product', compact('category', 'detail_product', 'cart', 'count_product', 'total_price', 'gallery'));
        } else {
            $gallery = Gallery::where('product_id', $product_id)->get();
            $category = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            $detail_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->join('tbl_specifications', 'tbl_specifications.product_id', '=', 'tbl_product.product_id')->where('tbl_product.product_id', $product_id)->first();
            return view('pages.product.show_detail_product', compact('category', 'detail_product', 'gallery'));
        }
    }

    public function search_product(Request $request)
    {
        $key_product = $request->key_product;
        $search_product = Product::join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->when($key_product, function ($query, $key_product) {
                return $query->where('product_name', 'like', '%' . $key_product . '%');
            })->paginate(4);
        return view('admin.product.search_product')->with('message', 'Các sản phẩm bạn muốn tìm')->with('search_product', $search_product);
    }


    public function filter()
    {
        if (Auth::user()) {
            $count_product = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->count();
            $cart = Cart::where('user_id', Auth::user()->user_id)->join('tbl_cart_detail', 'tbl_cart_detail.cart_id', '=', 'tbl_cart.cart_id')->join('tbl_product', 'tbl_product.product_id', '=', 'tbl_cart_detail.product_id')->get();
            $total_price = 0;
            foreach ($cart as $item) {
                $total_price += $item->quantity * $item->product_price;
            }
            $category = Category::where('category_status', '1')->orderByDesc('category_id')->get();


            if (isset($_GET['sort_by'])) {
                $sort_by = $_GET['sort_by'];
                $filtered_products = $this->getFilteredProducts($sort_by);
            }


            return view('pages.filter_home', compact('filtered_products', 'count_product', 'cart', 'total_price', 'category'));
        } else {
            if (isset($_GET['sort_by'])) {
                $sort_by = $_GET['sort_by'];
                $filtered_products = $this->getFilteredProducts($sort_by);
            }
            $category = Category::where('category_status', '1')->orderByDesc('category_id')->get();
            return view('pages.filter_home', compact('filtered_products', 'category'));
        }
    }


    private function getFilteredProducts($sort_by)
    {
        if ($sort_by === 'moinhat') {
            $filtered_products = Product::orderBy('created_at', 'desc')->paginate(9);
        } elseif ($sort_by === 'tuA_Z') {
            $filtered_products = Product::orderBy('product_name', 'asc')->paginate(9);
        } elseif ($sort_by === 'tuZ_A') {
            $filtered_products = Product::orderBy('product_name', 'desc')->paginate(9);
        } elseif ($sort_by === 'tangdan') {
            $filtered_products = Product::orderBy('product_price', 'asc')->paginate(9);
        } elseif ($sort_by === 'giamdan') {
            $filtered_products = Product::orderBy('product_price', 'desc')->paginate(9);
        } elseif ($sort_by === 'banchay') {
            $filtered_products = Product::orderBy('product_sold', 'desc')->paginate(9);
        }

        return $filtered_products;
    }



    public function filter_product()
    {
        if (isset($_GET['sort_by'])) {
            $sort_by = $_GET['sort_by'];
            $filtered_products = $this->getFilteredProductsAdmin($sort_by);
        }
        return view('admin.product.filter_product', compact('filtered_products'));
    }


    private function getFilteredProductsAdmin($sort_by)
    {
        if ($sort_by === 'moinhat') {
            $filtered_products = Product::orderBy('created_at', 'asc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        } elseif ($sort_by === 'tuA_Z') {
            $filtered_products = Product::orderBy('product_name', 'asc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        } elseif ($sort_by === 'tuZ_A') {
            $filtered_products = Product::orderBy('product_name', 'desc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        } elseif ($sort_by === 'tangdan') {
            $filtered_products = Product::orderBy('product_price', 'asc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        } elseif ($sort_by === 'giamdan') {
            $filtered_products = Product::orderBy('product_price', 'desc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        } elseif ($sort_by === 'banchay') {
            $filtered_products = Product::orderBy('product_sold', 'desc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->paginate(4);
        }

        return $filtered_products;
    }



    public function add_specifications(Request $request)
    {
        $this->AuthLogin();
        $product = Product::orderByDesc('product_id')->get();
        return view('admin.specifications.add_specifications_product')->with('product', $product);
    }

    public function save_specifications_product(Request $request)
    {
        $this->AuthLogin();
        $data = $request->all();
        $specifications = new Specifications();
        $specifications->cpu = $data['cpu'];
        $specifications->product_id = $data['product_id'];
        $specifications->ram = $data['ram'];
        $specifications->storage = $data['storage'];
        $specifications->graphics_card = $data['graphics_card'];
        $specifications->screen_size = $data['screen_size'];
        $specifications->screen_resolution = $data['screen_resolution'];
        $specifications->operating_system = $data['operating_system'];
        $specifications->weight = $data['weight'];
        $specifications->battery = $data['battery'];
        $specifications->connectivity_ports = $data['connectivity_ports'];
        $specifications->color = $data['color'];
        $specifications->keyboard = $data['keyboard'];
        $specifications->audio = $data['audio'];
        $specifications->size = $data['size'];

        $specifications->save();
        return redirect()->back()->with('message', 'Thêm thông số kỹ thuật sản phẩm thành công');
    }

    public function show_add_image($product_id)
    {
        return view('admin.product.show_add_image')->with('product_id', $product_id);
    }

    public function add_image_product(Request $request, $product_id)
    {
        $images = $request->file('images');
        if ($images) {
            foreach ($images as $image) {
                $gallery = new Gallery();
                $get_name_image = $image->getClientOriginalName();
                $name_image = current(explode('.', $get_name_image));
                $new_image = $name_image . '.' . $image->getClientOriginalExtension();
                $image->move('public/uploads/product', $new_image);
                $gallery->gallery_image = $new_image;
                $gallery->product_id = $product_id;
                $gallery->save();
            }
            return redirect()->back()->with('message', 'Thêm hình ảnh thành công');
        } else {
            return redirect()->back()->with('message', 'Thêm hình ảnh thất bại');
        }
    }
}