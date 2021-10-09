<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class HRDepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function allDepartments(){
        return response()->json(Department::get(['id', 'name']));
    }

    public function index(Request $request){
        return response()->json(Department::orderBy('name', $request->sort)->paginate(8));
    }

    public function store(DepartmentRequest $request){
        Department::create($request->validated());
        return $this->success('Department created successfully');
    }

    public function update(DepartmentRequest $request, $id){
        $department = Department::find($id);
        if(!empty($department)) {
            $department->update($request->validated());
            return $this->success('Department data updated successfully');
        }
        else {
            return response()->json(['msg' => 'Department id is invalid'], 422);
        }
    }
}
