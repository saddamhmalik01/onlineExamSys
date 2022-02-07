<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\attempt;
use App\Models\result;

class StudentController extends Controller
{
///////////////////////////////////////   WEB ////////////////////////////////////////

    /////////////////// admin view students ////////////////////////
public function index()
{
    if(session()->has('admin'))
    {
        $data = student::all();
        return view('admin.viewstudents',['data'=>$data]);
    }
    return redirect('/');
}

//////////////////// teacher view students ///////////////////
public function indexteacher()
{
    if(session()->has('teacher'))
    {
        $data = student::all();
        return view('teacher.viewstudents',['data'=>$data]);
    }
    return redirect('/');
}

 ////////////////// add student --teacher panel /////////////////////////
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
$stu = student::create($student);
if($stu)
{
    attempt::create([
        'student_id'=> $stu['id'],
        'attempts'=>'0'
        ]);
    if(session('admin'))
        return redirect('admin/viewstudents');
    elseif(session('teacher'))
        return redirect('teacher/viewstudents');
}
dd('validation error');
}



////////////////////// student login ///////////////////////////////
public function login(Request $request)
{
    $request->session()->flush();
    $cred = $request->validate([
        'email'=>'required|string',
        'password'=>'required|string'
    ]);
    $users = student::where('email',$cred['email'])->where('password',md5($cred['password']))->get();
    if(count($users)==1)
    {
        foreach($users as $user)
        $request->session()->put('class',$user->class);
        $request->session()->put('rollno',$user->rollno);
        $request->session()->put('email',$cred['email']);
        $request->session()->put('student','student');
        $request->session()->put('id',$user->id);
        $data[] = student::where('email',$cred['email'])->first();
        return redirect('studentdashboard');
    }
    return redirect('studentlogin');
}

//////////////////////// view student dashboard //////////////////////////////
public function studentdash()
{
         if(session()->has('student')){
            $user = student::where('email',session('email'))->get();
            $results = student::find(session('id'));

            $marks = $results->result->last();
            $results = student::find(session('id'));
            $count = count($results->result);
           return view('studentdashboard',['user'=>$user,'marks'=>$marks, 'count'=>$count]);
         }
         return redirect('studentlogin');

}

//////////////////////// student logout /////////////////////////
public function logout(Request $request)
{
    $request->session()->flush();
    return redirect('studentlogin');

}

////////////////////////////// Edit student --admin & teacher panel/////////////////////////
public function edit(Request $request)
{   if(session()->has('admin')||session()->has('teacher'))
    {
    $user = student::find($request['id']);
    if(session('admin'))
        return view('admin/editstudent',['user'=>$user]);
    elseif(session('teacher'))
        return view('teacher/editstudent',['user'=>$user]);
    }
    return redirect('/');
}

////////////////// update student data --admin admin and teacher panel /////////////////
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
            return redirect('admin/viewstudents');
        elseif(session('teacher'))
            return redirect('teacher/viewstudents');
    }
}


//////////////// Student password change --student panel ////////////////////
public function enterpassword(Request $request)
{
    return view('changepassword',['id'=> $request->id]);

}


//////////// view results --student panel /////////////////
public function results()
{
    if(session()->has('rollno'))
    {
    $result = student::find(session('id'))->result;
    return view('results',['result'=>$result]);
    }
    return redirect('studentdashboard');
}


////////////////////// delete student --admin panel //////////////
public function delete(Request $request)
    {
        $del = student::find($request->id)->delete();
        return redirect('admin/viewstudents');
    }

public function updatePwd(Request $request)
{
    $pwd = $request->validate([
        'password' =>'required',
        'password_c'=> 'required|same:password',
    ]);
    If($pwd)
    {
        $update = student::where('id',$request['id'])->update([
            'password'=> md5($request['password'])
        ]);
        return redirect('studentdashboard');
    }
    return dd('error');
}





///////////////////////////////////////////// API //////////////////////////////////////////////


//////////////   view students ///////////////
public function view()
{
    $students = student::get();
    return response()->json(['students'=> $students]);
}


//////////////////// edit student ////////////////////////
public function editstudent(Request $request)
{
    $request->validate([
        'name'=>'required',
        'father_name'=> 'required',
        'email'=>'required',
        'rollno'=>'required',
        'class'=>'required',
    ]);
    if(student::where('id',$request['id'])->update([
            'name'=> $request['name'],
            'father_name'=> $request['father_name'],
            'email'=> $request['email'],
            'rollno'=> $request['rollno'],
            'class'=>$request['class'],
            'updated_at'=> now()]))
        return response()->json([
            'message'=> 'Student data updated successfully'
            ]);
    return response()->json([
        'message'=>'Updation unsuccessful'
         ]);

}


///////////////////////// add student ////////////////////////////
public function createstudent(Request $request)
{
    if( $student = $request->validate([
        'name'=>'required|string',
        'father_name'=>'required|string',
        'class'=> 'required|string',
        'rollno'=>'required|string',
        'email'=>'required|unique:students,email',
    ]))
    {
        $student['password']= md5('password');
        $studentAdd = student::create($student);
        if($studentAdd)
        {
            $created = attempt::create([
                'student_id'=> $studentAdd->id,
                'attempts'=>'0',
            ]);
            if($created)
                return response()->json([
                    'message'=>"student created successfully",
                     ]);
                return response()->json([
                   'message'=>'student creation unsuccessful'
                     ]);
        }
        return response()->json(['message'=>'Error while adding student']);
    }
    return response()->json(['message'=>'Validation Failed']);

}



//////////////////////// student login /////////////////////// required = {email, password}
public function apistudentlogin(Request $request)
{
    $cred = $request->validate([
        'email'=>'required',
        'password'=>'required'
    ]);
    $users = student::where('email', $cred['email'])->where('password',md5($cred['password']))->get();
    if(count($users)=='1')
    return response()->json([
        'message'=>'Login success',
        'userdata'=>$users
    ]);
    return response()->json(['message'=> 'Invalid credentials']);
}


//////////////////// student change password /////////// required = { password,password_c,id }
public function passwordchange(Request $request)
{
    If($pwd = $request->validate([
        'password' =>'required',
        'password_c'=> 'required|same:password',
    ]))
    {
        $update = student::where('id',$request['id'])->update([
            'password'=> md5($request['password'])
        ]);
        if($update)
            return response()->json([
                'message'=> 'password changed successfully'
                ]);
            return response()->json([
                'message'=>'error while changing password'
                ]);
    }
    return response()->json(['message'=> 'Validation failed']);

}

//////////////// view results --student panel /////////// requires student id/////
public function viewresults(Request $request)
{
    $student = student::find($request['id']);
    if($student==null)
    return response()->json(['message'=>'No student found with this id']);
    $result = $student->result;
    if(count($result)=='0')
    return response()->json(['message'=>'No test attempted']);
    return response()->json(['result'=>$result]);
}



} ///////// end of file
