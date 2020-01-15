<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Hash;
use File;
use Auth;

class PostController extends Controller
{
    public function index()
    {
        /*$posts = Post::join('categories', 'posts.category_id', '=', 'categories.id')
                    ->join('users', 'posts.user_id', '=', 'users.id')
                    ->select('posts.id','posts.title','users.name', 'categories.name','posts.created_at')->orderBy('posts.id','DESC')->get()->toArray();*/
        $posts = Post::all();
        return view('admin.post.index',compact('posts'));
    }

    public function create()
    {
        $posts = Post::all();
        $categories = Category::all();
        return view('admin.post.create',compact('posts', 'categories'));
    }

    public function store(PostRequest $post_request)
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
        return redirect()->route('admin.post.index')->with(['alert-type' => 'success', 'message' => 'Tạo mới bài viết thành công!']);
    }

    public function show($id)
    {
        $post = Post::find($id);
        return view('admin.post.show',compact('post'));
    }

    public function edit($id)
    {
        $categories = Category::all();
        $post = Post::find($id);
        $post_avatar = Post::find($id)->avatar;
        return view('admin.post.edit',compact('categories','post','post_avatar'));
    }

    public function update(Request $request, $id)
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
        return redirect()->route('admin.post.index')->with(['alert-type' => 'success', 'message' => 'Cập nhật bài viết thành công!']);
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        File::delete(public_path('storage/upload/images').$post->avatar);
        $post->delete($id);
        return redirect()->route('admin.post.index')->with(['alert-type' => 'success', 'message' => 'Xoá bài viết thành công!']);
    }
}
