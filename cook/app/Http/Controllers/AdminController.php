<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Tag;
use App\Models\Recipe;
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
     * ユーザ一詳細を表示する
     */

   public function showDetail($id){

       $user = User::find($id);

       return view('admin.detail',['user' => $user]);
    

   }
   /**
     * ユーザー編集画面を表示する
     */

   public function showEdit($id){

       $user = User::find($id);

       return view('admin.edit',['user' => $user]);
    

   }

   /**
     * ユーザー更新をする
     */

    public function exeUpdate(Request $request){


        $inputs = $request->all();

       

        $user = User::find($inputs ['id']);
        $user->fill([
            'name' => $inputs['name'],
            'email' => $inputs['email']
        ]);
        $user->save();
        \DB::commit();
 
        return view('admin.edit',['user' => $user]);
     
 
    }


    // レシピ作成画面の表示
    public function create()
    {
        return view('admin.create');
    }

    //投稿のDBへのレコード作成
    public function store(Request $request)
     {
        $recipe = $request->validate([
            'name' => 'required|max:50',
            'text1' => 'required|max:2000',
        ]);

        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙]+)/u', $request->tags, $match);

        // $match[0]に#(ハッシュタグ)あり、$match[1]に#(ハッシュタグ)なしの結果が入ってくるので、$match[1]で#(ハッシュタグ)なしの結果のみを使います。
        $tags = [];
        foreach ($match[1] as $tag) {
            $record = Tag::firstOrCreate(['name' => $tag]);// firstOrCreateメソッドで、tags_tableのnameカラムに該当のない$tagは新規登録される。
            array_push($tags, $record);
            // $recordを配列に追加します(=$tags)
        };

        // 投稿に紐付けされるタグのidを配列化
        $tags_id = [];
        foreach ($tags as $tag) {
            array_push($tags_id, $tag['id']);
        };
         
        $image_path = $request->file('profile_image')->store('public/avatar/');
        
        $recipe = new Recipe;
        $recipe->name = $request->name;
        // $recipe->profile_image = $request->profile_image;
        $recipe->profile_image =  basename($image_path);

        $recipe->text1 = $request->text1;
        $recipe->text2 = $request->text2;

        $recipe->user_id = Auth::user()->id;
        $recipe->save();
        $recipe->tags()->attach($tags_id);
     

        return redirect()->route('admin');
    }

/**
     * ユーザー一覧を表示する
     */

    public function recipe_list(Request $request){

		$keyword = $request->input('keyword');

		$query = Recipe::query();
	
       
       

		if(!empty($keyword))
    {
$query->Where('name','like','%'.$keyword.'%');
   }



		$recipe_list = $query->orderBy("id", "desc")->paginate(10);
	
		return view("admin.recipe_list")->with('recipe_list',$recipe_list)->with('keyword',$keyword);
   }
    

   public function recipe_showDetail($id){

    $recipe = Recipe::find($id);

    return view('admin.recipe_detail',['recipe' => $recipe]);
 

}


public function recipe_showEdit($id){

    $recipe = Recipe::find($id);

    return view('admin.recipe_edit',['recipe' => $recipe]);
 

}

}
