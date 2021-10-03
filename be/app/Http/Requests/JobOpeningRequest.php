<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class JobOpeningRequest extends FormRequest
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
            'job_title' => 'bail|required|max:45',
            'job_salary_from' => 'required|max:40',
            'job_salary_to' => 'required|max:40',
            'job_description' => 'required',
            'job_requirements' => 'required',
            'job_skills' => 'required',
            'job_type' => 'required|max:40',
            'job_min_experience' => 'required|max:80',
            'job_min_qualification' => 'required|max:80',
            'job_work_location' => 'required|max:80',
            'job_opening_expiration' => 'required|max:40',
        ];
    }

    public function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
