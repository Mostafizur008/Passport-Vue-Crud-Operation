<?php

namespace App\Http\Controllers\School\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentController extends Controller
{
    public function Department(){
        $data = Department::all();
        return response()->json($data);
    }

    public function DPCreate(Request $request){
        $validator = validator::make($request->all(),[
            "department_name" => "required|min:3",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Department::create([
            'department_name' => $request->department_name,
        ]);

        return send_response('Department Create Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }


    public function DPUpdate(Request $request, $id){
        $validator = validator::make($request->all(),[
            "department_name" => "required|min:4",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Department::find($id);
        $data->department_name = $request->department_name;
        $data->save();

        return send_response('Department Update Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }


    public function Show($id){
        $data = Department::find($id);
        
        if ($data)
        return send_response('Success!', $data);
       else
        return send_error(['Data not found', $data]);
    }

    public function Destory($id){
        try{
            $data = Department::find($id);
            if($data){
            $data->delete();
            return send_response('Successfuly Remove', []);
            }else
            return send_response('All Ready Remove Data', []);
        }catch (Exception $e){
            return send_error("Somthing Wrong", $e->getCode());
        }
    }
}
