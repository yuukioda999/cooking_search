<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Models\Favorite;
use App\Models\Tag;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use App\Http\Requests\RecipeeditRequest;
use App\Http\Requests\UserRequest;
use Session;


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
        $request->session()->put('keyword',$keyword);
       
 
		return view("admin")->with('user_list',$user_list)->with('keyword',$keyword);
        
   }

   /**
     * ユーザ一詳細を表示する
     */

   public function showDetail($id,Request $request){

       $user = User::find($id);

       $keyword = $request->session()->get('keyword');
      
       
       

       return view('admin.detail',['user' => $user])->with('keyword',$keyword);
    
   
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

    public function exeUpdate(UserRequest $request){


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


    
     /**
     * レシピ作成画面の表示
     */
    public function create()
    {
        return view('admin.create');
    }

    //投稿のDBへのレコード作成
    
    public function store(RecipeRequest $request)
     {
        // $recipe = $request->validate([
        //     'name' => 'required|max:50',
        // ]);

        // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
        // preg_match_all('/#([a-zA-z0-9０-９ぁ-んァ-ヶ亜-熙ー-]+)/u', $request->tags, $match);
        preg_match_all('/#([a-zA-Z0-9ａ-ｚA-Zぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);

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
        $request->session()->put('keyword',$keyword);
       
		return view("admin.recipe_list")->with('recipe_list',$recipe_list)->with('keyword',$keyword);
   }
    

   public function recipe_showDetail($id,Request $request){

    $recipe = Recipe::find($id);
    $keyword = $request->session()->get('keyword'); 
    
    return view('admin.recipe_detail',['recipe' => $recipe])->with('keyword',$keyword);
 

}


public function recipe_showEdit($id){

    $recipe = Recipe::find($id);

    return view('admin.recipe_edit',['recipe' => $recipe]);
 

}



public function recipe_exeUpdate(RecipeeditRequest $request)
     {

        $inputs = $request->all();

       
            // レシピレシピを更新
           
            $recipe = Recipe::find($inputs['id']);
            $recipe->fill([
                'name' => $inputs['name'],
                'text1' => $inputs['text1'],
                'text2' => $inputs['text2'],   
            ]);
            // #(ハッシュタグ)で始まる単語を取得。結果は、$matchに多次元配列で代入される。
            preg_match_all('/#([a-zA-Z0-9ａ-ｚA-Zぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);
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
         preg_match_all('/#([a-zA-Z0-9ａ-ｚA-Zぁ-んァ-ヶー一-龠]+)/u', $request->tags, $match);

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
         if($request->has('profile_image')){
            $image_path = $request->file('profile_image')->store('public/avatar/');
            $recipe->profile_image =  basename($image_path);
         }else{
           
         }
          
        
           
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
   
    


    

    return view('home',compact('tags1','tags2','tags3','tags4','tags5','tags6','tags7','tags8','tags9'));
 

}




public function recipe_search(Request $request,Recipe $recipe){

    $user = auth()->user();

    // $recipe = new Recipe;

    // $recipe = Recipe::findOrFail($id); // findOrFail 見つからなかった時の例外処理

      $favorite = $recipe->favorites()->where('user_id', Auth::user()->id)->first();

$keyword = $request->input('keyword'); 
$keyword2 = $request->input('keyword2'); 
$keyword3 = $request->input('keyword3'); 
$keyword4 = $request->input('keyword4'); 
$keyword5 = $request->input('keyword5'); 
$keyword6 = $request->input('keyword6'); 
$keyword7 = $request->input('keyword7'); 
$keyword8 = $request->input('keyword8'); 
$keyword9 = $request->input('keyword9'); 
$keyword10 = $request->input('keyword10'); 

$query = Recipe::query();


if (isset($keyword)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword) . '%');

    $query->WhereHas('tags', function ($query) use ($keyword){
        $query->where('name', 'like', '%' . $keyword . '%');
    });
}

if (isset($keyword2)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword2){
        $query->where('name', 'like', '%' . $keyword2 . '%');
    });
}

if (isset($keyword3)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword3){
        $query->where('name', 'like', '%' . $keyword3 . '%');
    });
}

if (isset($keyword4)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword4){
        $query->where('name', 'like', '%' . $keyword4 . '%');
    });
}

if (isset($keyword5)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword5){
        $query->where('name', 'like', '%' . $keyword5 . '%');
    });
}

if (isset($keyword6)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword6){
        $query->where('name', 'like', '%' . $keyword6 . '%');
    });
}

if (isset($keyword7)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword7){
        $query->where('name', 'like', '%' . $keyword7 . '%');
    });
}

if (isset($keyword8)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword8){
        $query->where('name', 'like', '%' . $keyword8 . '%');
    });
}

if (isset($keyword9)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword9){
        $query->where('name', 'like', '%' . $keyword9 . '%');
    });
}

if (isset($keyword10)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword2) . '%');
    $query->WhereHas('tags', function ($query) use ($keyword10){
        $query->where('name', 'like', '%' . $keyword10 . '%');
    });
}

$tags = $query->orderBy('id', 'asc')->paginate(15);





return view('recipe_search', [
    'tags' => $tags,
    'user' => $user,
    'recipe' => $recipe,
    'keyword' => $keyword,
    'keyword2' => $keyword2,
    'keyword3' => $keyword3,
    'keyword4' => $keyword4,
    'keyword5' => $keyword5,
    'keyword6' => $keyword6,
    'keyword7' => $keyword7,
    'keyword8' => $keyword8,
    'keyword9' => $keyword9,
    'keyword10' => $keyword10,
    compact('recipe', 'favorite')
])->with(array('recipe' => $recipe, 'favorite' => $favorite));

   
}
public static function escapeLike($str)
{
    return str_replace(['\\', '%', '_'], ['\\\\', '\%', '\_'], $str);
}


public function recipe_Detail($id){

    $recipe = Recipe::find($id);

    return view('recipe_Detail',['recipe' => $recipe]);
 

}

public function mypage(Request $request){

    // $user = Auth::user();

    // // $favorites = Favorite::where('user_id', $user->id)->get();

    // $favorites = Favorite::where('user_id', $user->id)->get();
    // $name[] = $favorites;
    // dd($name);
    // return view("mypage",['user' => $user]);
    // $user_id = Auth::user();
 
    // $recipes = DB::table('recipes')
    //      ->join('favorites', 'recipe.id', '=', 'favorites.recipe_id')
    //      ->where('favorites.user_id', '=', $user_id)
    //      ->get();
    $user = auth()->user();


    $query = Recipe::query();

    $keyword =  $user->id;
  

if (isset($keyword)) {
    // $query->where('name', 'like', '%' . self::escapeLike($keyword) . '%');

    $query->WhereHas('favorites', function ($query) use ($keyword){
        $query->where('user_id', '=',  $keyword );
    });
}

     

       $recipes = $query->orderBy('id', 'asc')->paginate(15);

        return view('mypage')->with([
         'user' => $user,
         'recipes' => $recipes,
         'keyword' => $keyword
      ]);
}



/**
     * ユーザー編集画面を表示する
     */

    public function user_showEdit($id){

        $user = User::find($id);
 
        return view('user_edit',['user' => $user]);
     
 
    }



    /**
     * ユーザー更新をする
     */

    public function user_exeUpdate(UserRequest $request){

        

        $inputs = $request->all();     
        $user = User::find($inputs ['id']);
        $user->fill([
            'name' => $inputs['name'],
            'email' => $inputs['email']
        ]);
        $user->save();
        // \DB::commit();
 
        return view('user_edit',['user' => $user]);
   
 
    }


}
