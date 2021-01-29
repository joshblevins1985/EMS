<?php

namespace Vanguard\Http\Requests\Auth;

use Vanguard\Http\Requests\Request;
use Illuminate\Contracts\Validation\Factory as ValidationFactory;

class QaRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required',
            'employee_id'=> 'required' | 'numeric',
            'location' => 'required',
            'grade' => 'required',
            'protoco' => 'required',
            'comments' => 'required',
            'deficiencies' => 'required'
        ];
    }

    
}
