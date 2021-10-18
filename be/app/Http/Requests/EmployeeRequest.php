<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'first_name' => 'required|bail|max:30',
            'last_name' => 'required|bail|max:30',
            'contact_number' => 'required|bail|max:20',
            'gender' => 'required|bail|max:10',
            'address' => 'required|bail',
            'birthday' => 'required|bail',
            'emergency_contact_person' => 'required|bail',
            'emergency_contact_number' => 'required|bail',
            'date_hired' => 'required|bail|max:30',
            'wage' => 'required|bail|max:30',
            'overtime' => 'required|bail|max:30',
            'email' => 'required|unique:users,email',
            'status' => 'required|bail|max:30',
            'branch_id' => 'required|bail|exists:branches,id',
        ];
    }
}
