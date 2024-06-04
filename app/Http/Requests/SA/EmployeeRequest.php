<?php

namespace App\Http\Requests\SA;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
       // return false;
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'SelectPost'=>'',
            'SelectStruct'=>'',
            'internalPhoneNumber'=>'',
            'workPhoneNumber'=>'',
            'workplaceAddress'=>''
        ];
    }
}
