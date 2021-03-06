<?php

namespace App\Http\Requests\Searches;

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
            'brand_id' => ['array', 'nullable'],
            'catalog_id' => ['array', 'nullable'],
            'vs' => ['integer', 'max:100'],
            'dft' => ['integer', 'min:1'],
            'dry_to_touch' => ['numeric', 'min:-1'],
            'dry_to_handle' => ['numeric', 'min:-1'],
            'min_int' => ['numeric', 'min:-1'],
            'max_int' => ['numeric', 'min:-2'],
            'min_temp' => ['numeric', 'min:-20'],
            'max_service_temp' => ['integer', 'min:0'],
            'binders' => ['array', 'min:1'],
            'environments' => ['array', 'min:1'],
            'numbers' => ['array', 'min:1'],
            'resistances' => ['array', 'min:1'],
            'substrates' => ['array', 'min:1'],
            'additives' => ['array', 'min:1'],
            'tolerance' => ['string'],
            'title' => ['string', 'nullable', 'max:50'],
            'order-by' => ['string', 'nullable'],
            'search_title' => ['string', 'nullable'],
            'is_deleted' => ['integer', 'max:1']


        ];
    }
}
