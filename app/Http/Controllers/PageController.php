<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Hash;
use Auth;
use File;
use App\Http\Requests\PostRequest;

class PageController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function getIndex(){
        /*$posts = Post::join('category_post', 'category_post.post_id', '=', 'posts.id')
                ->join('categories', 'categories.id', '=', 'category_post.category_id')
                ->join('users', 'categories.user_id', '=', 'users.id')
                ->select('posts.id','posts.title','users.name', 'categories.name','posts.created_at')
                ->orderBy('id','DESC')/*->skip(0)->take(4)->get()->paginate(5);*/
        $posts = Post::select('*')->orderBy('id', 'desc')->paginate(5);
        return view('user.pages.home',compact('posts'));
    }

    public function categories(){
        $categories = Category::select('*')->get();
        return view('user.pages.categories',compact('categories'));
    }

    public function categoryDetail($id){
        $category = Category::find($id);
        $posts = $category->posts()->paginate(5);
        return view('user.pages.categorydetail',compact('posts'));
    }

    public function postCategory($id){
        $post_category = Post::select('*')->where('category_id',$id)->paginate(3);
        $post_related = DB::table('posts')->join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.id as cate_id', 'categories.name as cate_name')
            ->orderBy('id','DESC')->take(4)->get();
        /*if(isset($post_category[0]->cate_id)){
            $cate = DB::table('categories')->select('parent_id')->where('id',$post_category[0]->cate_id)->first();
            $menu_cate = DB::table('categories')->select('id','name')->where('parent_id',$cate->parent_id)->get();
        }*/
        return view('user.pages.cate',compact('post_category','post_related'));
    }
    public function postDetail($id){
        $post = Post::find($id);
//        $post_detail = Post::where('id',$id)->first();
//        $image = DB::table('post_images')->select('id','image')->where('post_id',$post_detail->id)->get();
//        $post_related = DB::table('posts')->where('cate_id',$post_detail->cate_id)->where('id','<>',$id)->take(4)->get();
        return view('user.pages.postdetail',compact('post'));
    }
    public function myAccount(){

        if(Auth::check()){
            $user_detail = User::find(Auth::user()->id);
            $posts = $user_detail->post()->paginate(5);
            $comments = $user_detail->comment()->paginate(5);
            $categories = $user_detail->category()->paginate(5);
            return view('user.pages.myaccount',compact('user_detail', 'posts', 'comments', 'categories'));
        } else{
            return redirect('login');
        }
    }
    public function postCreate(){
        $posts = Post::all();
        $categories = Category::all();
        return view('user.pages.postcreate',compact('posts', 'categories'));
    }

    public function postStore(PostRequest $post_request)
    {
        $file_name = $post_request->file('avatar')->getClientOriginalName();
        $post = new Post();
        $post->title = $post_request->txtTitle;
        $post->content = $post_request->txtContent;
        $post->avatar = $file_name;
        $post->user_id = Auth::user()->id;
        $post_request->file('avatar')->move(public_path('storage/upload/images'),$file_name);
        $post->save();
        $post->id;
        $post->categories()->attach($post_request->sltCategory);
        return redirect()->route('index')->with(['alert-type' => 'success', 'message' => 'Tạo mới bài viết thành công!']);
    }
    public function postEdit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        $post_avatar = Post::find($id)->avatar;
        return view('user.pages.postedit',compact('categories','post','post_avatar'));
    }

    public function postUpdate(Request $request, $id)
    {
        $post = Post::find($id);
        $post->title = $request->input('txtTitle');
        $post->content = $request->input('txtContent');
        $post->user_id = Auth::user()->id;
        $img_current = public_path('storage\upload\images').$request->input('img_current');
        if (!empty($request->file('avatar'))) {
            $file_name = $request->file('avatar')->getClientOriginalName();
            $post->avatar = $file_name;
            $request->file('avatar')->move(public_path('storage/upload/images'),$file_name);
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }
        $post->save();
        $post->categories()->sync($request->input('sltCategory'));
        return redirect()->route('index')->with(['alert-type' => 'success', 'message' => 'Cập nhật bài viết thành công!']);
    }

    public function userDetail($id){
        $user = User::find($id);
        $posts = $user->post()->paginate(5);
        $comments = $user->comment()->paginate(5);
        $categories = $user->category()->paginate(5);
        return view('user.pages.userdetail',compact('user', 'posts', 'comments', 'categories'));
    }

    public function getEditAccount(){
        $user_edit = User::find(Auth::user()->id);
        return view('user.pages.edit-account',compact('user_edit'));
    }

    public function postEditAccount(Request $request){
        $user = User::find(Auth::user()->id);
        if($request->input('txtPass')){
            $this->validate($request,
                [
                    'txtRePass' => 'required|same:txtPass'
                ],
                [
                    'txtRePass.required' => 'Vui lòng nhập lại mật khẩu',
                    'txtRePass.same'    => 'Mật khẩu nhập lại không khớp!'
                ]
            );
            $pass = $request->input('txtPass');
            $user->password = Hash::make($pass);
        }
        $user->name = $request->txtFName;
        $user->email = $request->txtEmail;
        $user->birthday = $request->txtBirthday;
        $user->phoneNumber = $request->txtPhoneNumber;
        $img_current = public_path('storage\upload\images').$request->input('img_current');
        if (!empty($request->file('avatar'))) {
            $file_name = $request->file('avatar')->getClientOriginalName();
            $user->avatar = $file_name;
            $request->file('avatar')->move(public_path('storage/upload/images'),$file_name);
            if (File::exists($img_current)) {
                File::delete($img_current);
            }
        }

        $user->save();
        /*$user->roles()->sync($request->role);*/
        return redirect()->route('myaccount')->with(['alert-type' => 'success', 'message' => 'Cập nhật tài khoản thành công']);
    }

    public function postSearch(Request $request){
        $key_search  = $request->get('key_search');
        $post_search = Post::where('title','like',"%$key_search%")->take(9)->get();
        $post_related =Post::join('categories', 'categories.id', '=', 'posts.category_id')
            ->select('posts.*', 'categories.id as cate_id', 'categories.name as cate_name')
            ->orderBy('id','DESC')->take(4)->get();
        return view('user.pages.search',['post_search'=>$post_search,'key_search'=>$key_search,'post_related'=>$post_related]);
    }

    public function adminPage(){
        return view('admin.master');
    }
}
