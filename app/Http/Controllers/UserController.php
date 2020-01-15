<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;
use Hash;
use Auth;
use File;
// use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('admin.user.index',compact('users'));
    }

    public function create()
    {
        $users = User::all();
        $roles = Role::all();
        return view('admin.user.create',compact('roles', 'users'));
    }

    public function store(UserRequest $request)
    {
        $file_name = $request->file('avatar')->getClientOriginalName();
        $user = new User();
        $user->name = $request->txtFName;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->avatar = $file_name;
        $user->birthday = $request->txtBirthday;
        $user->phoneNumber = $request->txtPhoneNumber;
        $user->status = 0;
        $user->is_active = 1;
        $request->file('avatar')->move(public_path('storage/upload/images'),$file_name);
        $user->save();
        $user->id;
        $user->roles()->attach($request->role);
        return redirect()->route('admin.user.index')->with(['alert-type' => 'success', 'message' => 'Tạo mới người dùng thành công!']);
    }

    public function show($id)
    {
        $user = User::find($id);
        return view('admin.user.show',compact('user'));
    }

    public function edit($id)
    {
        $user = User::find($id);
        //dd(Auth::user()->roles->first()->name);
        $roles = Role::all();
        if ((Auth::user()->id != $id) && $user->roles->first()->name == 'Admin') {
            return redirect()->route('admin.user.index')->with(['alert-type' => 'warning', 'message' => 'Bạn không có quyền chỉnh sửa! Truy cập bị từ chối']);
        }
        return view('admin.user.edit',compact('user','id','roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
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
        /*if($request->input('role')){
            $user->roles()->sync($request->role);
        }*/
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
        $user->roles()->sync($request->role);
        return redirect()->route('admin.user.index')->with(['alert-type' => 'success', 'message' => 'Cập nhật tài khoản thành công']);
    }

    public function destroy($id)
    {
        $user = User::find($id);
        if (($user->roles->first()->name == 'Admin') || ($user->roles->first()->name == 'Admin' && ($user['id'] != Auth::user()->id))) {
            return redirect()->route('admin.user.index')->with(['alert-type' => 'error', 'message' => 'Truy cập bị từ chối!']);
        }else{
            File::delete(public_path('storage/upload/images').$user->avatar);
            $user->delete($id);
            return redirect()->route('admin.user.index')->with(['alert-type' => 'success', 'message' => 'Xoá tài khoản thành công!']);
        }
    }

    public function updateActive(Request $request)
    {
        $user = User::findOrFail($request->user_id);
        $user->is_active = $request->is_active;
        $user->save();
        return response()->json(['message' => 'Đã thay đổi trạng thái thành công']);
    }
}
