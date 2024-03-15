<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'type' => 'required',
            'address' => 'required|array',
            'address.street' => 'required|string',
            'address.city' => 'required|string',
            'address.state' => 'required|string',
            'address.zip' => 'required|string',
            'address.country' => 'required|string',
        ];
    }
}
