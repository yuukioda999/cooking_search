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
     
    
    

        return redirect()->route('recipe_list');
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



public function recipe_exeUpdate(Request $request)
     {

        $inputs = $request->all();

       
            // ブログを更新
           
            $recipe = Recipe::find($inputs['id']);
            $recipe->fill([
                'name' => $inputs['name'],
                'text1' => $inputs['text1'],
                'text2' => $inputs['text2'],   
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
            $recipe->profile_image =  basename($image_path);
        
           
            $recipe->save(); 
            $recipe->tags()->sync($tags_id);
 
        
        return redirect()->route('recipe_list');
    }



    public function exeDelete($id)
    {
        $recipe = Recipe::find($id);
        $recipe->delete();
      

         return redirect()->route('recipe_list');
    }


    /**
     * レシピ検索画面を表示する
     */

   public function recipeSearch(Request $request){

    // $tags = Tag::inRandomOrder()->take(5)->get();
    // $tags = \DB::table('tags')->first();     
    // $tags = Tag::inRandomOrder()->first();

    $tags1 = Tag::inRandomOrder()->take(1)->get();
    $tags2 = Tag::inRandomOrder()->take(1)->get();
    $tags3 = Tag::inRandomOrder()->take(1)->get();
    $tags4 = Tag::inRandomOrder()->take(1)->get();
    $tags5 = Tag::inRandomOrder()->take(1)->get();
    $tags6 = Tag::inRandomOrder()->take(1)->get();
    $tags7 = Tag::inRandomOrder()->take(1)->get();
    $tags8 = Tag::inRandomOrder()->take(1)->get();
    $tags9 = Tag::inRandomOrder()->take(1)->get();
    $tags10 = Tag::inRandomOrder()->take(1)->get();
  
    


    

    return view('home',compact('tags1','tags2','tags3','tags4','tags5','tags6','tags7','tags8','tags9','tags10'));
 

}




public function recipe_search(Request $request){


$keyword = $request->input('keyword'); //商品名の値
$keyword2 = $request->input('keyword2'); //カテゴリの値

$query = Tag::query();

if (isset($keyword)) {
    $query->where('name', 'like', '%' . self::escapeLike($keyword) . '%');
}

if (isset($keyword2)) {
    $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
}

$tags = $query->orderBy('id', 'asc')->paginate(15);


$category = new Recipe;
$categories = $category->getLists();

$tags = Tag::with('recipes')->get();

return view('recipe_search', [
    'tags' => $tags,
    'categories' => $categories,
    'keyword' => $keyword,
    'keyword2' => $keyword2
]);

   
}
public static function escapeLike($str)
{
    return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
}


}
