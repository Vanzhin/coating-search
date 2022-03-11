<?php

namespace App\Http\Requests\Searches;

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
            'brand_id' => ['integer', 'nullable'],
            'catalog_id' => ['integer', 'nullable'],
            'vs' => ['integer', 'max:100'],
            'dft' => ['integer', 'min:1'],
            'dry_to_touch' => ['integer', 'min:0'],
            'dry_to_handle' => ['integer', 'min:0'],
            'min_int' => ['integer', 'min:0'],
            'max_int' => ['integer', 'min:-2'],
            'min_temp' => ['integer', 'min:-20'],
            'max_service_temp' => ['integer', 'min:0'],
            'binders' => ['array', 'min:1'],
            'environments' => ['array', 'min:1'],
            'numbers' => ['array', 'min:1'],
            'resistances' => ['array', 'min:1'],
            'substrates' => ['array', 'min:1'],
            'tolerance' =>['string'],
        ];
    }
}
