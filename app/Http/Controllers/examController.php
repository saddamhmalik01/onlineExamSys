<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tenth;
use App\Models\twelve;
use Illuminate\Support\Facades\DB;
use App\Models\attempt;
use App\Models\result;
use App\Models\student;

use function PHPUnit\Framework\countOf;

class examController extends Controller
{
    public function index(Request $request)
    {
        if(session()->has('teacher'))
            return view('teacher/addqns',['qns'=>$request['qns'],'class'=>$request['class']]);
        else
            return redirect('welcome');
    }


    ////////////// add questions  --teacher panel ///////////////
    public function add(Request $request)
    {
        $no = $request['no'];
        DB::table($request['class'])->delete();
        for($x=0;$x<$no;$x++)
        {
            DB::table($request['class'])->insert([
                'Question'=> $request['qns'.+$x],
                'a'=> $request['a'.+$x],
                'b'=> $request['b'.+$x],
                'c'=> $request['c'.+$x],
                'd'=> $request['d'.+$x],
                'ans'=> $request['ans'.+$x],
            ]);
        }
        $students = student::where('class',$request['class'])->get('id');
        foreach($students as $student)
        attempt::where('student_id',$student->id)->update(['attempts'=>'0']);
        return redirect('teacher/dashboard');
    }


    public function test()
    {
        if(session()->has('student'))
        {
            $test = DB::table(session('class'))->get();
            $students = student::find(session('id'));
            $attempt = $students->attempt->attempts;

            if($attempt == '0')
                return view('test',['test'=>$test,'class'=>session('class')]);
            return view('already');
    }
}



    public function submittest(Request $request)
    {
        $answers = DB::table($request['class'])->pluck('ans')->toArray();
        $true = [];
        $false=[];

        for($x=0;$x<$request['no'];$x++)
        {
        if($request['ans'.+$x+1] == $answers[$x])
                $true[] = '1';
                $false[] = '0';
        }
        if(result::create([
            'student_id'=>session('id'),
            'correct'=>count($true),
            'wrong'=>count($false),
            'total'=>$request['no'],
            'dateTime'=>now()
        ]))
        {  attempt::where('student_id',session('id'))->update(['attempts'=>'1']);
            return redirect('studentdashboard');
        }
    }


    // ***********************************************************API****************************************

///////////////////////////////// Add test question --teacher panel///// requires no of questions('no'), class
public function createtest(Request $request)
{
    $no = $request['no'];
    DB::table($request['class'])->delete();
    for($x=0;$x<$no;$x++)
    {
        DB::table($request['class'])->insert([
            'Question'=> $request['qns'.+$x],
            'a'=> $request['a'.+$x],
            'b'=> $request['b'.+$x],
            'c'=> $request['c'.+$x],
            'd'=> $request['d'.+$x],
            'ans'=> $request['ans'.+$x],
        ]);
    }
    $students = student::where('class',$request['class'])->get('id');
    foreach($students as $student)
    attempt::where('student_id',$student->id)->update(['attempts'=>'0']);
    return response()->json(['message'=>'Test added successful']);


}
//////////////////////////// student start test --student panel /////////////////////
public function starttest(Request $request)  //// requires student id //////////////
{
    $student = student::find($request['id']);
    if($student->attempt->attempts=='0'){
        $test = DB::table($student->class)->get();
        return response()->json([
             'test'=> $test
                ]);
    }
    return response()->json(['message'=> 'You have already attempted']);
}


//////////////////// student submit test --student panel ////////// requires ans[1-n], class, student id
public function apisubmittest(Request $request)
{
    $answers = DB::table($request['class'])->pluck('ans')->toArray();

    for($x=0;$x<$request['no'];$x++)
    {
    if($request['ans'.+$x+1] == $answers[$x])
        $true[] = '1';
        $false[] = '0';
    }
    if(result::create([
        'student_id'=> $request['id'],
        'correct'=>count($true),
        'wrong'=>count($false),
        'total'=>$request['no'],
        'dateTime'=>now()
    ]))
    {
        attempt::where('student_id',session('id'))->update(['attempts'=>'1']);
        return response()->json(['message'=>'Test submitted successfully']);
    }


}




} //end of file


