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

    public function index(){
        return response()->json(Employee::with([
            'info', 
            'employment', 
            'employment.branch:id,name', 
            'employment.overtime:id,name', 
            'employment.position:id,name', 
            'employment.workpolicy:id,policy_name', 
            'modules'
            ])->paginate(8));
    }

    public function store(EmployeeRequest $request){
        $empModule = $this->storeEmployeeModule($request);
        $empInfo = $this->storeEmployeeInfo($request);
        $empEmploymentInfo = $this->storeEmployeeEmploymentInfo($request);

        Employee::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
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
            'image' => $data->image
        ]);

        return $employeeInfo;
    }

    public function storeEmployeeEmploymentInfo($data){
        $employeeEmploymentInfo = EmployeeEmploymentInfo::create([
            'date_hired' => $data->date_hired,
            'wage' => $data->wage,
            'overtime_rate' => $data->overtime,
            'regular_holiday_rate' => $data->regular_holiday_rate,
            'holiday_rate' => $data->holiday,
            'position_id' => $data->position_id,
            'status' => $data->status,
            'work_policy_id' => $data->work_policy_id,
            'over_time_policy_id' => $data->over_time_policy_id,
            'branches_id' => $data->branch_id,
        ]);

        return $employeeEmploymentInfo;
    }

    public function destroy($id){
        $employee = Employee::find($id);
        if($employee){
            $employee->modules()->delete();
            $employee->info()->delete();
            $employee->employment()->delete();
            $employee->delete();
            return $this->success('Employee deleted successfully');
        }
        else {
            return $this->error('Something went wrong');
        }
    }
}
