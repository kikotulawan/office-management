<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\JobApplicant;
use App\Models\UserInfo;
use App\Models\UserRole;

class UserAuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'store']]);
    }

    public function login(Request $request)
    {
        if (! $token = auth()->guard('api')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    public function me()
    {
        $user = User::with(['info'])->where('id', auth()->guard('api')->user()->id)->first();
        return response()->json($user);
    }

    public function jobApplied()
    {
        $jobapplied = JobApplicant::with(['user', 'jobapplied'])->where('user_id', auth()->guard('api')->user()->id)->paginate(8);
        return response()->json($jobapplied);
    }

    public function logout()
    {
        auth()->logout();
        return response()->json(['message' => 'User logged out successfully!']);
    }

    public function store(Request $request){
        
        $userinfodata = [
            'first_name' => $request->first_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'age' => $request->age,
            'address' => $request->address,                                          
            'birthday' => $request->birthday,
            'isAdmin' => $request->is_admin,
            'image' => $request->image,
            'isAdmin' => false
        ];

        $userinfo = UserInfo::create($userinfodata);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'user_info_id' => $userinfo->id,
        ]);

        UserRole::create([
            'role_id' => 2,
            'user_id' => $user->id
        ]);

        return $this->success('Account created successfully!');
    }

    protected function respondWithToken($token)
    {
        $user = UserInfo::where('id', auth('api')->user()->id)->first();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 120,
            'user_info' => $user,
            'user_account' => auth('api')->user(),
        ]);
    }
}
