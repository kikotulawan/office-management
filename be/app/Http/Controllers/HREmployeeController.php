<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Models\User;
use App\Models\UserEmploymentInfo;
use App\Models\UserInfo;
use App\Models\UserModule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HREmployeeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return response()->json(User::with([
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
        $empInfo = $this->storeEmployeeInfo($request);
        $empEmploymentInfo = $this->storeEmployeeEmploymentInfo($request);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_info_id' => $empInfo->id,
            'user_employment_info_id' => $empEmploymentInfo->id,
        ]);

        $userModule = $this->storeEmployeeModule($request, $user);

        return $this->success('Employee created successfully');
    }

    public function storeEmployeeModule($data, $user){
        $data->work_module == true ? UserModule::create(['module_id' => 2, 'user_id' => $user->id]) : '';
        $data->human_resource == true ? UserModule::create(['module_id' => 1, 'user_id' => $user->id]) : '';
        $data->sales_marketing == true ? UserModule::create(['module_id' => 3, 'user_id' => $user->id]) : '';
        $data->accounting == true ? UserModule::create(['module_id' => 4, 'user_id' => $user->id]) : '';
        $data->purchasing == true ? UserModule::create(['module_id' => 5, 'user_id' => $user->id]) : '';
        $data->corporate_directory == true ? UserModule::create(['module_id' => 6, 'user_id' => $user->id]) : '';
        $data->project_manager == true ? UserModule::create(['module_id' => 7, 'user_id' => $user->id]) : '';

        return;
    }

    public function storeEmployeeInfo($data){
        $employeeInfo = UserInfo::create([
            'first_name' => $data->first_name,
            'middle_name' => $data->middle_name,
            'last_name' => $data->last_name,
            'contact_number' => $data->contact_number,
            'gender' => $data->gender,
            'address' => $data->address,
            'birthday' => $data->birthday,
            'isAdmin' => $data->is_admin,
            'emergency_contact_person' => $data->emergency_contact_person,
            'emergency_contact_number' => $data->emergency_contact_number,
            'image' => $data->image
        ]);

        return $employeeInfo;
    }

    public function storeEmployeeEmploymentInfo($data){
        $employeeEmploymentInfo = UserEmploymentInfo::create([
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
        $employee = User::find($id);
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
