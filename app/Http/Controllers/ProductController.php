<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    //Admin page
    public function AuthLogin()
    {
        $admin_id = Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dasboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderByDesc('category_id')->get();
        $brand_product = DB::table('tbl_brand')->orderByDesc('brand_id')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    public function get_all_product()
    {
        $this->AuthLogin();
        $get_all_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderByDesc('product_id')->get();
        $manager_product = view('admin.get_all_product')->with('get_all_product', $get_all_product);
        return view('admin_layout')->with('admin.get_all_product', $manager_product);
    }

    public function save_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $data['product_tags'] = $request->product_tags;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_sold'] = 0;
        $data['product_slug'] = $request->product_slug;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        } else {
            $data['product_image'] = '';
            DB::table('tbl_product')->insert($data);
            Session::put('message', 'Thêm sản phẩm thành công');
            return Redirect::to('add-product');
        }
    }

    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 1]);
        Session::put('message', 'Không kích hoạt sản phẩm thành công');
        return Redirect::to('get-all-product');
    }

    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->update(['product_status' => 0]);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('get-all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderByDesc('category_id')->get();
        $brand_product = DB::table('tbl_brand')->orderByDesc('brand_id')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);
        return view('admin_layout')->with('admin.edit_product', $manager_product);
        Session::put('message', 'Kích hoạt sản phẩm thành công');
        return Redirect::to('get-all-product');
    }

    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id', $product_id)->delete();
        Session::put('message', 'Xóa sản phẩm thành công');
        return Redirect::to('get-all-product');
    }


    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['category_id'] = $request->category_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['product_price'] = $request->product_price;
        $data['product_status'] = $request->product_status;
        $get_image = $request->file('product_image');

        if ($get_image) {
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . '.' . $get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product', $new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('get-all-product');
        } else {
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            Session::put('message', 'Cập nhật sản phẩm thành công');
            return Redirect::to('get-all-product');
        }
    }
    //End admin page

    public function detail_product(Request $request, $product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderByDesc('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderByDesc('brand_id')->get();

        $detail_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_product.product_id', $product_id)->get();

        foreach ($detail_product as $key => $item) {
            $category_id = $item->category_id;
            $meta_desc = $item->category_desc;
            $meta_keywords = $item->meta_keywords;
            $meta_title = $item->category_name;
            $link_url = $request->url();
        }

        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();

        return view('pages.product.show_detail_product')->with('category', $cate_product)->with('brand', $brand_product)->with('detail_product', $detail_product)->with('related_product', $related_product)->with('meta_desc', $meta_desc)->with('meta_keywords', $meta_keywords)->with('meta_title', $meta_title)->with('link_url', $link_url);
    }

    public function add_specifications(Request $request)
    {
        $this->AuthLogin();
        $product = DB::table('tbl_product')->orderByDesc('product_id')->get();
        return view('admin.add_specifications_product')->with('product', $product);
    }

    public function save_specifications_product(Request $request)
    {
        $this->AuthLogin();
        $data = array();
        $data['cpu'] = $request->cpu;
        $data['product_id'] = $request->product_id;
        $data['ram'] = $request->ram;
        $data['storage'] = $request->storage;
        $data['graphics_card'] = $request->graphics_card;
        $data['screen_size'] = $request->screen_size;
        $data['screen_resolution'] = $request->screen_resolution;
        $data['operating_system'] = $request->operating_system;
        $data['weight'] = $request->weight;
        $data['battery'] = $request->battery;
        $data['connectivity_ports'] = $request->connectivity_ports;
        $data['color'] = $request->color;
        $data['keyboard'] = $request->keyboard;
        $data['webcam'] = $request->webcam;
        $data['audio'] = $request->audio;
        $data['size'] = $request->size;

        DB::table('tbl_specifications')->insert($data);
        Session::put('message', 'Thêm thông số kỹ thuật sản phẩm thành công');
        return Redirect::to('add-specifications-product');
    }
}
