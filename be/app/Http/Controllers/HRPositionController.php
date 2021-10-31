<?php

namespace App\Http\Controllers;

use App\Http\Requests\PositionRequest;
use App\Models\Position;
use Illuminate\Http\Request;

class HRPositionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function allPositions(){
        return response()->json(Position::get(['id','name']));
    }

    public function index(Request $request){
        return response()->json(Position::orderBy('name', $request->sort)->paginate(8));
    }

    public function store(PositionRequest $request){
        Position::create($request->validated());
        return $this->success('Position created successfully');
    }

    public function update(PositionRequest $request, $id){
        $position = Position::find($id);
        if(!empty($position)) {
            $position->update($request->validated());
            return $this->success('Position data updated successfully');
        }
        else {
            return response()->json(['msg' => 'Position id is invalid'], 422);
        }
    }
}
