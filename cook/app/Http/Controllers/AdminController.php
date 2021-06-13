<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        # 追加したmiddlewareを追加。
        $this->middleware('admin');
    }
 
     public function index(){

        return view('admin');
    //    dd('admin画面です。');
    }
}
