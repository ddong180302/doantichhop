<?php

namespace App\Http\Controllers;

use App\Models\Order;
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
        return view('admin.dashboard');
    }

    public function filter_dashboard(Request $request)
    {
        //$data = $request->all();

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        //dd($startDate, $endDate);
        //Kiểm tra và xử lý dữ liệu timestamp
        // $startTimestamp = strtotime($startDate . ' 00:00:00');
        // $endTimestamp = strtotime($endDate . ' 23:59:59');

        // Lấy dữ liệu phù hợp từ cơ sở dữ liệu (ví dụ: bảng "items")
        $filteredItems = Order::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('admin.dashboard', compact('$filteredItems'));
    }
}
