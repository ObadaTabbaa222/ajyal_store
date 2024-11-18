<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $id = $this->route('product');
        return [
            'name' => [
                'required',
                'min:3',
                'max:191',
                Rule::unique('products', 'name')->ignore($id),
                // new Filter(['php','laravel','html'])
                'forbidden:php,laravel,css'
            ],
            'image' => [
                'nullable',
                'image',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2048',
                'dimensions:min_width=100,min_height=100'
            ],
            'category_id' => 'nullable|exists:categories,id',
            'store_id' => 'nullable|exists:stores,id',
            'status' => 'required|in:active,archived,draft',
        ];
    }

    public function messages() //تقوم بعرض رسائل مخصصة لكل خطأ
    {
        return [
            'name.unique' => 'This name is alrady exists!', //تخصيص الرسالة لحقل الاسم بالتحديد لخطأ تكرار الإسم
            'required' => 'This field (:attribute) is required', //تخصيص رسالة بحسب نوع الخطأ بغض النظر عن نوع الحقل
        ];
    }
}
