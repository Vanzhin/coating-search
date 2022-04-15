<?php

namespace App\Http\Requests\Comments;

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
            'sender_email' => [ 'required', 'email'],
            'sender_name' => [ 'required', 'max:200'],
            'target' => ['string', 'required'],
            'target_id' => ['integer', 'required'],
            'sender_id' => ['integer', 'required'],
            'message' => [ 'required', 'max:500'],
        ];
    }
}
