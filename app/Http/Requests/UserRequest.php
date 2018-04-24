<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

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
            //
			'name' => 'required|between:3,25|regex:/^[A-Za-z0-9\-\_]+$/|unique:users,name,' . Auth::id(),
			'email' => 'required|email',
			'age' => 'integer',
			'wechat' => 'filled',
			'img' => 'file|image|between:0,1024|mimes:jpeg,bmp,png,gif|dimensions:min_width=200,min_height=200',
			'introduction' => 'max:80',
        ];
    }
}
