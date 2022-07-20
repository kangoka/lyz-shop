<?php

namespace App\Http\Requests\User\Review;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class Store extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'rating'  => 'required|numeric|min:1|max:5',
            'comment' => 'required|string|min:10|max:100'
        ];
    }
}
