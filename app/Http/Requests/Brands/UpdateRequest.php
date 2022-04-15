<?php

namespace App\Http\Requests\Brands;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'title'=>['min:5', 'required', 'string',
                Rule::unique('brands')->ignore($this->brand->id, 'id')],

        ];
    }
}
