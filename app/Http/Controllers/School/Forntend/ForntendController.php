<?php

namespace App\Http\Controllers\School\Forntend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Student;
use DB;

class ForntendController extends Controller
{
    public function Results(){
        $results = DB::table('results');
        $results = $results
               ->leftJoin('students','students.id','results.student_id')
               ->leftJoin('departments','departments.id','students.department_id')
               ->select('students.name','results.id','departments.department_name','results.gpa')
               ->orderBy('results.gpa', 'desc')
               ->get();
        return response()->json(
            [
                'results' => $results,
                'message' => 'Results',
                'code' => 200
        ]);
    }

    public function Students()
    {
        $students = DB::table('students');
        $students = $students
            ->join('results', 'results.student_id', '=', 'students.id')
            ->leftJoin('departments', 'departments.id', '=', 'students.department_id')
            ->select('students.name', 'students.id', 'departments.department_name', 'results.gpa')
            ->orderBy('results.gpa', 'desc')
            ->get();
            
        return response()->json(
            [
                'students' => $students,
                'message' => 'Students',
                'code' => 200
            ]
        );
    }
    
}
