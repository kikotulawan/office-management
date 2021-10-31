<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Permission, Role, PermissionRole};
use Illuminate\Support\Facades\Gate;
class RolePermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['all']]);
    }
    
    public function all(){
        $rolepermission = Permission::get();
        return response()->json($rolepermission);
    }

    public function index(){

        if(!Gate::allows('has_permissions')){
            return $this->error('User has no permission');
        }

        $permission = Role::with(['permission:id,permission'])->paginate(8);
        return response()->json($permission);
    }

    public function searchRole(Request $request){
        if(!Gate::allows('has_permissions')){
            return $this->error('User has no permission');
        }
        $permission = Role::where('role', 'like', '%'.$request->search.'%')->with(['permission:id,permission'])->paginate(8);
        return response()->json($permission);
    }

    public function store(Request $request)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if(!Gate::allows('has_permissions')){
            return $this->error('User has no permission');
        }
       PermissionRole::where('role_id', $id)->delete();
       foreach($request->permission as $permission){
           PermissionRole::create([
               'permission_id' => $permission['id'],
               'role_id' => $id
           ]);
       }

       return response()->json(['msg' => 'Role permissions updated successfully!'], 200);
    }

    public function destroy($id)
    {
        if(!Gate::allows('has_permissions')){
            return $this->error('User has no permission');
        }
        PermissionRole::where('role_id', $id)->delete();
        return response()->json(['msg' => 'All permissions were removed'], 200);
    }
}
