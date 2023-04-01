<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StudentPutRequest extends FormRequest
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
    public function prepareForValidation()
    {
        $this->merge([
            'id' => $this->route('student')->id
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'id' => 'required',
            'f_name' => 'required',
            'l_name' => 'required',
            'age' => 'required|integer',
            'department' =>'required|integer|digits_between:1, 10',
            'subjects' => 'required|array',
            'subjects.*' => 'required|integer', Rule::exists('subjects')->where('department_id', $this->request->get('department'))
        ];
    }
}
