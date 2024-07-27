<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Stores;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    // ログイン画面遷移
    public function login() {
        return view('login');
    }
    /**
     * 店舗一覧
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $store = new Stores;
        $all = $store->all()->toArray();
        return view('top');
    }

    // ユーザー登録
    public function Signup() {
        return view('auth/register');
    }

    // 店舗新規登録

    public function StoreSignupform() {
        return view('auth/register_store');
    }

    public function StoreSignup(Request $request) {
        $store = new Stores;
        $user = new User;

        $id = Auth::id();

        dd($request);

        $file_name = $request->file('pic')->getClientOriginalName();
        $request->file('pic')->storeAs('public/images', $file_name);
        
        $store = $user::find(\Auth::id());
   
       
        $store->pic = 'storage/images/' . $file_name;
        $store->user_id = $id;
        $store->store_name = $request->store_name;
        $store->comment = $request->comment;
        $store->address = $request->address;


        Auth::user()->stores()->save($store);

        return view('top');



    }

    
}
