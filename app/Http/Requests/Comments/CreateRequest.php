<?php

namespace App\Http\Requests\Comments;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'sender_email' => [ 'required', 'email'],
            'sender_name' => [ 'required', 'max:200'],
            'target' => ['string', 'nullable'],
            'target_id' => ['integer', 'nullable'],
            'sender_id' => ['integer', 'nullable'],
            'message' => [ 'required', 'max:500'],
        ];
    }
}
