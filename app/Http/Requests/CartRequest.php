<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartRequest extends FormRequest
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
            //
            "qty"=>'required|numeric'
        ];
    }
    public function messages()
    {
      return[
          "qty.required"=>"this field shoudnot be empty",
          "qty.numeric"=>"this field shoud be numeric",
      ];
    }

}
