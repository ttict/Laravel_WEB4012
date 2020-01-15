<?php

namespace App\Http\Controllers;
use App\Http\Requests\CateRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
       /* $categories = Category::join('users', 'categories.user_id', '=', 'users.id')
                        ->select('categories.id','categories.name','users.name')
                        ->orderBy('categories.id','DESC')->get()->toArray();*/
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }

    public function create()
    {
        /*$categories = Category::select('id','name','user_id')->get()->toArray();*/
        $categories = Category::all();
        return view('admin.category.create',compact('categories'));
    }

    public function store(CateRequest $request)
    {
        $category = new Category();
        $category->name = $request->txtCateName;
        $category->user_id = Auth::user()->id;
        $category->save();
        return redirect()->route('admin.category.index')->with(['alert-type' => 'success', 'message' => 'Tạo mới danh mục thành công!']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit',compact('category','id'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,
            ["txtCateName"=>"required"],
            ["txtCateName.required"=>"Vui lòng nhập tên danh mục!"]
        );
        $category = Category::find($id);
        $category->name = $request->txtCateName;
        $category->save();
        return redirect()->route('admin.category.index')
        ->with(['alert-type' => 'success', 'message' => 'Cập nhật danh mục thành công!']);
    }


    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete($id);
        return redirect()->route('admin.category.index')->with(['alert-type' => 'success', 'message' => 'Xoá danh mục thành công!']);
    }
}
