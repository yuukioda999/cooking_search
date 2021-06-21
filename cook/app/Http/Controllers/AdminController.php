<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        # 追加したmiddlewareを追加。
        $this->middleware('admin');
    }
 
    //  public function index(){

    //     return view('admin');
    // //    dd('admin画面です。');
    // }
    function showUserList(Request $request){

		$keyword = $request->input('keyword');

		$query = User::query();

		if(!empty($keyword))
{
$query->where('email','like','%'.$keyword.'%')->orWhere('name','like','%'.$keyword.'%');
}



		$user_list = $query->orderBy("id", "desc")->paginate(10);
		return view("admin")->with('user_list',$user_list)->with('keyword',$keyword);
	}

}
