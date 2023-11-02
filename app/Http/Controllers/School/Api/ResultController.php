<?php

namespace App\Http\Controllers\School\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Result;
use DB;

class ResultController extends Controller
{
    public function Result(Request $request){
        $results = DB::table('results');
        $results = $results
        ->join('students','results.student_id','=','students.id')
        ->select('students.name','results.id','results.gpa','results.date')
        ->get();
        return response()->json(
         [
             'results' => $results,
             'message' => 'Results',
             'code' => 200
     ]);
    }

    public function RSCreate(Request $request){
        $validator = validator::make($request->all(),[
            "gpa" => "required"
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Result::create([
            'gpa' => $request->gpa,
            'student_id' => $request->student_id,
            'date' => $request->date,
        ]);

        return send_response('Result Create Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }

    public function RSUpdate(Request $request, $id){
        $validator = validator::make($request->all(),[
            "gpa" => "required",
        ]);
        if($validator->fails())
        return send_error('Validation error', $validator->errors(), 422);

       try{
        $data = Result::find($id);
        $data->gpa = $request->gpa;
        $data->student_id = $request->student_id;
        $data->date = $request->date;
        $data->save();

        return send_response('Result Update Success!', $data);

       }catch(Exception $e){
        return send_error($e->getMessage(), $e->getCode());
       }
    }


    public function Show($id){
        $data = Result::find($id);
        
        if ($data)
        return send_response('Success!', $data);
       else
        return send_error(['Data not found', $data]);
    }

    public function Destory($id){
        try{
            $data = Result::find($id);
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
