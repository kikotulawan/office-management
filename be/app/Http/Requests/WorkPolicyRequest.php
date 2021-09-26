<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkPolicyRequest extends FormRequest
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
            'policy_name' => 'required|bail|max:50',
            'morning_start' => 'required|bail|max:25',
            'morning_end' => 'required|bail|max:25',
            'afternoon_start' => 'required|bail|max:25',
            'afternoon_end' => 'required|bail|max:25',
            'grace_period' => 'required|bail|max:10',
        ];
    }
}
