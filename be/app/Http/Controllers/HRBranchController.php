<?php

namespace App\Http\Controllers;

use App\Http\Requests\BranchRequest;
use App\Models\Branch;
use Illuminate\Http\Request;

class HRBranchController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function allBranches(){
        return response()->json(Branch::get(['id', 'name']));
    }

    public function index(Request $request){
        return response()->json(Branch::orderBy('name', $request->sort)->paginate(8));
    }

    public function store(BranchRequest $request){
        Branch::create($request->validated());
        return $this->success('Branch created successfully');
    }

    public function update(BranchRequest $request, $id){
        $branch = Branch::find($id);
        if(!empty($branch)) {
            $branch->update($request->validated());
            return $this->success('Branch data updated successfully');
        }
        else {
            return response()->json(['msg' => 'Branch id is invalid'], 422);
        }
    }
}
