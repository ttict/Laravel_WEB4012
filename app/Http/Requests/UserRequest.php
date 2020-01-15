<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'txtFName' => 'required',
            'txtEmail'  => 'required|unique:users,email|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'txtPass'   => 'required',
            'txtRePass' => 'required|same:txtPass',
            'txtBirthday' => 'required',
            'txtPhoneNumber'  => 'required|unique:users,phoneNumber|digits_between:10,11|numeric',
            'avatar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }
    public function messages(){
        return [
            'txtFName.required' => 'Vui lòng nhập đầy đủ họ và tên!',
            'txtEmail.required' =>  'Vui lòng nhập email!',
            'txtEmail.unique'    => 'Email đã tồn tại!',
            'txtEmail.regex' => 'Vui lòng nhập chính xác địa chỉ Email!',
            'txtPass.required' => 'Vui lòng nhập mật khẩu!',
            'txtRePass.required' => 'Vui lòng nhập lại mật khẩu!',
            'txtRePass.same'    => 'Mật khẩu nhập lại không khớp!',
            'txtBirthday.required' => 'Vui lòng nhập ngày tháng năm sinh',
            'txtPhoneNumber.required' => 'Vui lòng nhập số điện thoại!',
            'txtPhoneNumber.unique' => 'Số điện thoại đã tồn tại',
            'txtPhoneNumber.digits_between' => 'Số điện thoại từ 10 đến 11 số!',
            'txtPhoneNumber.numeric' => 'Số điện thoại phải là số!',
            'avatar.required' => 'Vui lòng chọn ảnh',
            'avatar.image' => 'Vui lòng chọn ảnh',
            'avatar.mimes' => 'Vui lòng chọn đúng định dạng ảnh (jpeg, png, jpg)',
            'avatar.max' => 'Dung lượng ảnh phải nhỏ hơn 2048KB'
        ];
    }
}
