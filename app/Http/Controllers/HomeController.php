<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{

    public function send_mail()
    {
        $name = 'test mail for mail';
        Mail::send('pages.send_mail', compact('name'), function ($email) {
            $email->subject('Test send mail');
            $email->to('trandangdong18032002@gmail.com', 'mail meo');
        });
        // //send mail
        // $to_name = "Trần Đăng Đông";
        // $to_email = "trandangdong1803@gmail.com"; //send to this email

        // $data = array("name" => "noi dung ten", "body" => "noi dung body"); //body of mail.blade.php

        // Mail::send("pages.send_mail", $data, function ($message) use ($to_name, $to_email) {
        //     $message->to($to_email)->subject("test mail nhé"); //send this mail with subject
        //     $message->from($to_email, $to_name); //send from this mail
        // });
        //--send mail
        // return Redirect::to('/');
    }

    public function index(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderByDesc('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderByDesc('brand_id')->get();
        $all_product = DB::table('tbl_product')->where('product_status', '0')->orderByDesc('product_id')->limit(4)->get();

        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    public function search(Request $request)
    {
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '0')->orderByDesc('category_id')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '0')->orderByDesc('brand_id')->get();


        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keywords . '%')->get();

        // $get_all_product = DB::table('tbl_product')
        // ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        // ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->orderByDesc('product_id')->get();
        // $manager_product = view('admin.get_all_product')->with('get_all_product', $get_all_product);


        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }
}
