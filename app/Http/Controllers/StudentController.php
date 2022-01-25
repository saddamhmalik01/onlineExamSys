<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
public function index()
{
    if(session()->has('admin'))
    {
        $data = student::all();
        return view('admin.viewstudents',['data'=>$data]);
    }
    return redirect('/');
}


public function indexteacher()
{
    if(session()->has('teacher'))
    {
        $data = student::all();
        return view('teacher.viewstudents',['data'=>$data]);
    }
    return redirect('/');
}

public function add(Request $request)
{
$student = $request->validate([
    'name'=>'required|string',
    'father_name'=>'required|string',
    'class'=> 'required|string',
    'rollno'=>'required|string',
    'email'=>'required|unique:students,email',

]);
$student['password']= md5('password');
if(student::create($student))
{
    DB::table('attempts')->insert(['class'=> $student['class'],'attempts'=> '0','rollno'=>$student['rollno']]);
    if(session('admin')){
    return redirect('admin/viewstudents');
    }
    elseif(session('teacher'))
    {
        return redirect('teacher/viewstudents');
    }
}
else{
//validation error
}
}


public function login(Request $request)
{
    $request->session()->flush();
    $cred = $request->validate([
        'email'=>'required|string',
        'password'=>'required|string'
    ]);
    $users = DB::table('students')
                ->where('email', '=', $cred['email'])
                ->where('password', '=',md5($cred['password']))
                ->get();
    if(count($users)==1)
    {
        foreach($users as $user)
        $request->session()->put('class',$user->class);
        $request->session()->put('rollno',$user->rollno);
        $request->session()->put('email',$cred['email']);
        $request->session()->put('student','student');
        $data[] = DB::table('students')->where('email',$cred['email'])->first();
        return redirect('studentdashboard');
    }
    else
    {
        return redirect('studentlogin');
    }


}
public function studentdash()
{
         if(session()->has('student')){
            if(session('class')=='10th'){$class= 'tenth';}
            if(session('class')=='12th'){$class = 'twelve';}
            $user =DB::table('students')->where('email',session('email'))->get();
            $marks = DB::table('results')->orderBy("id",'desc')->where('rollno',session('rollno'))->where('class',$class)->first();
            $count = count(DB::table('results')->where('class',$class)->where('rollno',session('rollno'))->get());
            //return $marks;
           return view('studentdashboard',['user'=>$user,'marks'=>$marks, 'count'=>$count]);
         }
         return redirect('studentlogin');

}
public function logout(Request $request)
{
    $request->session()->flush();
    return redirect('studentlogin');

}
public function edit(Request $request)
{   if(session()->has('admin')||session()->has('teacher'))
    {
    $user = DB::table('students')->where('id',$request->id)->get();
    if(session('admin'))
        {
        return view('admin/editstudent',['user'=>$user]);
    }
    elseif(session('teacher'))
    {
        return view('teacher/editstudent',['user'=>$user]);
    }
    }
    else
    {
        return redirect('/');

    }
}

public function update(Request $request)
{
    $update = DB::table('students')->where('id',$request['id'])->update([
        'name'=> $request['name'],
        'father_name'=> $request['father_name'],
        'email'=> $request['email'],
        'rollno'=> $request['rollno'],
        'class'=>$request['class']
    ]);
    if($update)
    {
        if(session('admin'))
        {
            return redirect('admin/viewstudents');
        }
        elseif(session('teacher'))
        {
            return redirect('teacher/viewstudents');
        }
    }
}

public function enterpassword(Request $request)
{
    return view('changepassword',['id'=> $request->id]);

}
public function results()
{
    if(session()->has('rollno'))
    {
    if(session('class')=='10th'){ $class = 'tenth';}
    if(session('class')=='12th'){ $class = 'twelve';}
    $result = DB::table('results')->where('rollno',session('rollno'))->where('class',$class)->get();
    return view('results',['result'=>$result]);
    }
    else
    {
        return redirect('studentlogin');
    }
}
public function delete(Request $request)
    {
        $del = student::find($request->id)->delete();
        return redirect('admin/viewstudents');
    }





}
