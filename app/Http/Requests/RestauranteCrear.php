<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RestauranteCrear extends FormRequest
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
            'nombre'=>'required|string|max:30',
            'valoracion'=>'required|int|min:0|max:10',
            'tipo'=>'required|string|max:10',
            'foto'=>'required|mimes:jpg,png,jpeg,webp,svg'
        ];
    }
}
