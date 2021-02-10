<?php

namespace Vanguard\Http\Requests\Auth;

use Vanguard\Http\Requests\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class LoginRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'employee_id' => 'required',
        ];
    }
}
