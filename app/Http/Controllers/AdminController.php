<?php

namespace App\Http\Controllers;

use App\Models\Login;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use App\Rules\Captcha;
use Illuminate\Support\Facades\Auth;

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
}
