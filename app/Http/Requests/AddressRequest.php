<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
          'ip' => 'nullable|required_with:port|ip',
          'port'=>'nullable|required_with:ip|numeric|min:0|not_in:0|max:65535',
          'file'=>'required_without_all:ip,port|mimes:csv,txt|max:3000'
        ];
    }
}
