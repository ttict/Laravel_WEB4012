<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'txtTitle' => 'required|unique:posts,title',
            'txtContent' => 'required',
            'sltCategory' =>'required',
            // 'fImages' => 'required|image'
        ];
    }
    public function messages() {
        return [
            'txtTitle.required' => 'Vui lòng nhập tiêu đề bài viết!',
            'txtTitle.unique' => 'Tên danh mục đã tồn tại!',
            'txtContent.required' => 'Vui lòng nhập nội dung bài viết!',
            'sltCategory.required' => 'Vui lòng chọn danh mục!',
            // 'fImages.required'  => 'Vui lòng chọn ảnh!',
            // 'fImages.image' => 'Vui lòng chọn đúng định dạng file ảnh!'
        ];
    }
}
