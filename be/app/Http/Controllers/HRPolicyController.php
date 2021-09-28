<?php

namespace App\Http\Controllers;

use App\Http\Requests\WorkPolicyRequest;
use App\Models\WorkPolicy;
use App\Models\PolicyDay;
use Illuminate\Http\Request;

class HRPolicyController extends Controller
{
    public function index(Request $request){
        return response()->json(WorkPolicy::with(['policydays:id,work_policies_id,day,time_start,time_end'])->orderBy('policy_name', $request->sort)->paginate(8));
    }

    public function store(WorkPolicyRequest $request){
        $workpolicy = WorkPolicy::create($request->validated());
        $this->storeDays($request->time_schedule, $workpolicy->id);
        return $this->success('Work Policy created successfully');
    }

    public function storeDays($schedule, $id){
        foreach($schedule as $sched){
            foreach($sched['days'] as $day){
                PolicyDay::create([
                    'work_policies_id' => $id,
                    'day' => $day,
                    'time_start' => $sched['time'][0],
                    'time_end' => $sched['time'][1],
                ]);
            }
        }
    }

    public function update(WorkPolicyRequest $request, $id){

    }

    public function destroy($id){
        WorkPolicy::destroy($id);
        PolicyDay::where('work_policies_id', $id)->delete();

        return $this->success('Work Policy removed successfully');
    }
}
