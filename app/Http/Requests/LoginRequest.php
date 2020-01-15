<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class LoginRequest extends FormRequest
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
            'txtEmail' => 'required|regex:/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/',
            'txtPass' =>'required',
        ];
    }
    public function messages(){
        return[
            'txtEmail.required' => 'Vui lòng nhập Email',
            'txtEmail.regex' => 'Vui lòng nhập chính xác địa chỉ Email!',
            'txtPass.required' => 'Vui lòng nhập mật khẩu',
        ];
    }
}
