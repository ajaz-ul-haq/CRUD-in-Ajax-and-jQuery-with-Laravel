<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class userController extends Controller
{
    public function index(){
        return view('index');
    }

    public function view(){
        $students = Student::all();
        return response()->json([
            'studs'=>$students,
        ]);
    }

    public function editor($id=1){
        $student = Student::find($id);
        return response()->json([
            'student'=>$student,
        ]);
    }

    public function edit_student(Request $request,$id=1){
        $validator = Validator::make($request->all(),[
            'edit_id'=>'required',
            'edit_name'=>'required',
            'edit_email'=>'required|email',
            'edit_phone'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'400',
                'errors'=>$validator->messages()
            ]);
        }
        else{
            $student = Student::find($request->input('edit_id'));
            $student->name = $request->input('edit_name');
            $student->email = $request->input('edit_email');
            $student->phone = $request->input('edit_phone');
            $student->created_at = Carbon::Now();
            $student->updated_at = Carbon::Now();
            $student->save();

            return response()->json([
                'status'=>'200',
                'message'=>'User Updated Successfully'
            ]);
        }
    }

    public function delete($id=null){
        $student = Student::find($id);
        if($student){
            $student->delete();
            return response()->json([
                'status'=>1583,
            ]);
        }
        else{
            return response()->json([
                'status'=>1584,
            ]);
        }

    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status'=>'400',
                'errors'=>$validator->messages()
            ]);
        }
        else{
            $student = new Student;
            $student->name = $request->input('name');
            $student->email = $request->input('email');
            $student->phone = $request->input('phone');
            $student->created_at = Carbon::Now();
            $student->updated_at = Carbon::Now();
            $student->save();

            return response()->json([
                'status'=>'200',
                'message'=>'User Added Successfully'
            ]);
        }
    }
}
