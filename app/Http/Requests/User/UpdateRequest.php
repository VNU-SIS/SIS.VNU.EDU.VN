<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => 'required',
            'sex' => 'required|numeric',
            'phone' => 'numeric|nullable',
            // 'department_id' => 'required|numeric',
        ];
    }

    public function validated()
    {
        $paramValidated = $this->validator->validated();

        return $paramValidated;
    }
}