<?php

namespace App\Http\Requests\Products;

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
                Rule::unique('products')->ignore($this->product->id, 'id')],
            'description' => ['min:30', 'required', 'string'],
            'brand_id' => ['required', 'string'],
            'catalog_id' => ['required', 'string'],
            'vs' => ['required', 'integer', 'max:100'],
            'dft' => ['required', 'integer', 'min:15'],
            'dry_to_touch' => ['required', 'numeric', 'min:0'],
            'dry_to_handle' => ['required', 'numeric', 'min:0'],
            'min_int' => ['required', 'numeric', 'min:0'],
            'max_int' => ['numeric', 'min:-1', 'nullable'],
            'min_temp' => ['required', 'integer', 'min:-20'],
            'max_service_temp' => ['required', 'integer', 'min:0'],
            'pds-link' => ['nullable', 'url'],
            'pds-local' => ['file', 'mimes:pdf', 'max:2048', 'nullable'],
            'binders' => ['required', 'array', 'min:1'],
            'environments' => ['required', 'array', 'min:1'],
            'numbers' => ['required', 'array', 'min:1'],
            'resistances' => ['nullable', 'array', 'min:1'],
            'substrates' => ['required', 'array', 'min:1'],
            'tolerance' =>['string'],
        ];
    }
}
