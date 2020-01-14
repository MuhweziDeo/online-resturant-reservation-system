<?php

namespace App\Http\Requests;


class CreateTableRequest extends APIRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        return auth('api')->check() && auth('api')->user()->admin == true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'seat_number' => 'required|integer'
        ];
    }
}
