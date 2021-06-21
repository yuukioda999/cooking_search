<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * ユーザー一覧を表示する
     */

    public function showUserList(Request $request){

		$keyword = $request->input('keyword');

		$query = User::query();

		if(!empty($keyword))
    {
$query->where('email','like','%'.$keyword.'%')->orWhere('name','like','%'.$keyword.'%');
   }



		$user_list = $query->orderBy("id", "desc")->paginate(10);
		return view("admin")->with('user_list',$user_list)->with('keyword',$keyword);
   }

   /**
     * ユーザー一詳細を表示する
     */

   public function showDetail($id){

       $user = User::find($id);

       return view('admin.detail',['user' => $user]);
    

   }

}
