<?php

namespace App\Http\Controllers\School\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Exception;
use Auth;


class AuthController extends Controller
{
    public function Index(){
        $users = User::all();
        return response()->json(['All User Info Success', $users]);
    }
    public function Login (Request $request){

        $validator = validator::make($request->all(),[
                 "email" => "required|email",
                 "password" => "required",
             ]);

             if($validator->fails())
             return send_error('Validation error', $validator->errors(), 422);

             /* if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
             ])){
                $user = Auth::user();
                $ressArr = [];
                $ressArr['token'] = $user->createToken('user-api')->accessToken;
                $ressArr['name'] = $user->name;
                return send_response('Your are successfuly Logged In', $ressArr, 200);
             }else{
                return send_error('Unauthorised', 203);
             }*/

             $credentials = $request->only('email','password');

             if(Auth::attempt($credentials)){
                $user = Auth::user();
                $data ['name'] = $user->name;
                $data ['access_token'] = $user->createToken('accessToken')->accessToken;
                return send_response('Your are successfuly Logged In', $data);
             }else{
                return send_error('Unauthorised', '', 401);
             }
    }

    public function Register (Request $request){
       $validator = validator::make($request->all(),[
            "name" => "required|min:4",
            "email" => "required|email|unique:users",
            "password" => "required|min:8",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $data =[
            'name' => $user->name,
            'email' => $user->email,
        ];
        return send_response('Users Registation Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }

    public function Logout(Request $request){
        auth()->user()->token()->revoke();
        return response()->json(["message" => "Logout Successfully"]);
    }

    public function Show($id){
        $user = User::find($id);
        
        if ($user)
        return send_response('Success!', $user);
       else
        return send_error(['Data not found', $user]);
    }
}
