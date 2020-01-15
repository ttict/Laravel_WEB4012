<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Http\Requests\UserRequest;
use App\Models\User;
use App\Models\Role;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
    public function getRegister(){
        return view('auth.register');
    }

    public function postRegister(UserRequest $request){
        $file_name = $request->file('avatar')->getClientOriginalName();
        $roles = Role::all();
        $user = new User();
        /*$user->roles->first()->name;*/
        $user->name = $request->txtFName;
        $user->email = $request->txtEmail;
        $user->password = Hash::make($request->txtPass);
        $user->avatar = $file_name;
        $user->birthday = $request->txtBirthday;
        $user->phoneNumber = $request->txtPhoneNumber;
        $user->is_active = 0;
        $user->status = 0;
        $request->file('avatar')->move(public_path('storage/upload/images'),$file_name);
        $user->save();
        $user->id;
        if($roles->count() != 0) {
            foreach ($roles as $role) {
                if ($role->name == 'User') {
                    $user->roles()->attach($role->id);
                }
            }
        };
        /*$user->roles()->attach($role->id);*/
        return redirect('index')->with(['message' => 'Đã tạo tài khoản thành công','alert-type' => 'success']);
    }
}
