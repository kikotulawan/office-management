<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\Employee;
use App\Models\EmployeeEmploymentInfo;
use App\Models\EmployeeInfo;
use App\Models\EmployeeModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HREmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function store(EmployeeRequest $request){
        $empModule = $this->storeEmployeeModule($request);
        $empInfo = $this->storeEmployeeInfo($request);
        $empEmploymentInfo = $this->storeEmployeeEmploymentInfo($request);

        Employee::create([
            'email' => $request->email,
            'password' => Hash::create($request->password),
            'employee_info_id' => $empInfo->id,
            'employee_employment_info_id' => $empEmploymentInfo->id,
            'employee_module_id' => $empModule->id
        ]);

        return $this->success('Employee created successfully');
    }

    public function storeEmployeeModule($data){
        $employeeModule = EmployeeModule::create([
            'has_work_module' => $data->work_module,
            'has_human_resource' => $data->human_resource,
            'has_sales_marketing' => $data->sales_marketing,
            'has_accounting' => $data->accounting,
            'has_purchasing' => $data->purchasing,
            'has_corporate_directory' => $data->corporate_directory,
            'has_project_manager' => $data->project_manager,
        ]);

        return $employeeModule;
    }

    public function storeEmployeeInfo($data){
        $employeeInfo = EmployeeInfo::create([
            'first_name' => $data->first_name,
            'middle_name' => $data->middle_name,
            'last_name' => $data->last_name,
            'contact_number' => $data->contact_number,
            'gender' => $data->gender,
            'address' => $data->address,
            'birthday' => $data->birthday,
            'emergency_contact_person' => $data->emergency_contact_person,
            'emergency_contact_number' => $data->emergency_contact_number,
        ]);

        return $employeeInfo;
    }

    public function storeEmployeeEmploymentInfo($data){
        $employeeEmploymentInfo = EmployeeEmploymentInfo::create([
            'date_hired' => $data->date_hired,
            'wage' => $data->wage,
            'overtime' => $data->overtime,
            'regular_holiday_rate' => $data->regular_holiday_rate,
            'holiday' => $data->holiday,
            'position' => $data->position,
            'status' => $data->status,
            'work_policy_id' => $data->work_policy_id,
            'over_time_policy_id' => $data->over_time_policy_id,
            'branches_id' => $data->branch_id,
        ]);

        return $employeeEmploymentInfo;
    }
}
