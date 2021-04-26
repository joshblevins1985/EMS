<?php

namespace Vanguard\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDrugBagInspectionPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'drugBagId' => 'required',
            'oldSeal' => 'required',
            'newSeal' => 'required',
            'assignedId' => 'required',
            'witnessId' => 'required'
        ];
    }
}
