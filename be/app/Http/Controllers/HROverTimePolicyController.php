<?php

namespace App\Http\Controllers;

use App\Http\Requests\OverTimePolicyRequest;
use App\Models\OverTimePolicy;
use Illuminate\Http\Request;

class HROverTimePolicyController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function allOverTimePolicy(){
        return response()->json(OverTimePolicy::get(['id','name']));
    }

    public function index(Request $request){
        return response()->json(OverTimePolicy::orderBy('name', $request->sort)->paginate(8));
    }

    public function store(OverTimePolicyRequest $request){
        OverTimePolicy::create($request->validated());
        return $this->success('Overtime Policy created successfully');
    }

    public function update(OverTimePolicyRequest $request, $id){
        $overtime = OverTimePolicy::find($id);
        if(!empty($overtime)) {
            $overtime->update($request->validated());
            return $this->success('Overtime Policy data updated successfully');
        }
        else {
            return response()->json(['msg' => 'Overtime Policy id is invalid'], 422);
        }
    }

    public function destroy($id){
        OverTimePolicy::destroy($id);
        return $this->success('Overtime Policy removed successfully');
    }

}
