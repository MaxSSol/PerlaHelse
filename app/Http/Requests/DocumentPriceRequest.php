<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentPriceRequest extends FormRequest
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
            'CitySender' => 'required|string',
            'CityRecipient' => 'required|string',
            'Weight' => 'required|string',
            'ServiceType' => 'required|string',
            'Cost' => 'required|string',
            'CargoType' => 'required|string',
            'SeatsAmount' => 'required|string',
            'Amount' => 'string',
            'PackCount' => 'string',
            'PackRef' => 'string',
        ];
    }
}
