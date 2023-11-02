<?php

namespace App\Http\Controllers\School\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Student;
use DB;

class StudentController extends Controller
{
    public function Student(Request $request){
        $students = DB::table('students');
        $students = $students
        ->leftJoin('departments','departments.id','students.department_id')
        ->select('students.name','students.id','departments.department_name','students.batch_name')
        ->orderBy( 'id','asc')
        ->get();
        return response()->json(
         [
             'students' => $students,
             'message' => 'Students',
             'code' => 200
     ]);
    }

    public function STCreate(Request $request){
        $validator = validator::make($request->all(),[
            "name" => "required|min:4",
            "batch_name" => "required|min:2",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Student::create([
            'name' => $request->name,
            'department_id' => $request->department_id,
            'batch_name' => $request->batch_name,
        ]);

        return send_response('Student Create Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }


    public function STUpdate(Request $request, $id){
        $validator = validator::make($request->all(),[
            "name" => "required",
            "batch_name" => "required",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Student::find($id);
        $data->name = $request->name;
        $data->department_id = $request->department_id;
        $data->batch_name = $request->batch_name;
        $data->save();

        return send_response('Student Update Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }


    public function Show($id){
        $data = Student::find($id);
        
        if ($data)
        return send_response('Success!', $data);
       else
        return send_error(['Data not found', $data]);
    }

    public function Destory($id){
        try{
            $data = Student::find($id);
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
