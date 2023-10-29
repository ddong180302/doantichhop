<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Order_Detail;
use App\Models\Product;
use App\Models\Users;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class AdminController extends Controller
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
    public function show_dashboard()
    {
        $this->AuthLogin();
        $filteredItems = Order::get();
        $users = Users::where('user_status', 1)->count();
        $AllQuantityProduct = Product::sum('product_quantity');
        $AllSoldQuantityProduct = Product::sum('product_sold');
        $AllProductImport = $AllQuantityProduct + $AllSoldQuantityProduct;
        $countOrder = 0;
        $sumProducts = [];
        foreach ($filteredItems as $order) {
            $countOrder++;
            $sumProduct = Order_Detail::where('order_id', $order->order_id)->sum('product_quantity');
            $sumProducts[] = $sumProduct; // Lưu trữ tổng số lượng sản phẩm vào mảng
        }
        $sumProductOrder = 0;
        foreach ($sumProducts as $quantityProduct) {
            $sumProductOrder += $quantityProduct;
        }

        return view('admin.dashboard', compact('countOrder', 'sumProductOrder', 'AllQuantityProduct', 'AllProductImport', 'users'));
    }

    public function filter_dashboard(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $users = Users::where('user_status', 1)->count();
        $filteredItems = Order::whereBetween('created_at', [$startDate, $endDate])->get();
        $AllQuantityProduct = Product::whereBetween('created_at', [$startDate, $endDate])->sum('product_quantity');
        $AllSoldQuantityProduct = Product::whereBetween('created_at', [$startDate, $endDate])->sum('product_sold');
        $AllProductImport = $AllQuantityProduct + $AllSoldQuantityProduct;
        $countOrder = 0;
        $sumProducts = [];
        foreach ($filteredItems as $order) {
            $countOrder++;
            $sumProduct = Order_Detail::where('order_id', $order->order_id)->sum('product_quantity');
            $sumProducts[] = $sumProduct; // Lưu trữ tổng số lượng sản phẩm vào mảng
        }

        $sumProductOrder = 0;
        foreach ($sumProducts as $quantityProduct) {
            $sumProductOrder += $quantityProduct;
        }


        return view('admin.filter-dashboard', compact('countOrder', 'sumProductOrder', 'AllQuantityProduct', 'AllProductImport', 'users'));
    }
}
