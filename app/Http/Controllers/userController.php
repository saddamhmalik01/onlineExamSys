<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
/////////////////////////////////////////   WEB  //////////////////////////////////////////

    ////////////////  Staff Login //////////////////////
   public function index(Request $request)
   {
        $request->session()->flush();
        $cred = $request->only('email','password');
        if(Auth::attempt($cred))
        {


            $role = Auth::user()->role;
            if($role =='admin')
            {
                $request->session()->put('admin',$cred['email']);
                return redirect('admin/dashboard');
            }
            elseif($role == 'teacher')
            {
                $request->session()->put('teacher',$cred['email']);
                return redirect('teacher/dashboard');
            }

        }
        else
        {
            return redirect('/');

        }
    }
    ////////////////////// staff redirection /////////////////////
    public function user()
    {
        if(session()->has('admin'))
        {
            $data = DB::table('users')->where('role','teacher')->get();
            $admin = Auth::user();
            return view('admin.dashboard',['data'=> $data,'admin'=>$admin]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect('/');

    }
//////////////////////////// admin password change //////////////////////////////////
    public function changepassword(Request $request)
    {
        if($request['password']==$request['password_c'])
        {
            $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

            if($user)
            {
               return redirect('admin/dashboard');
            }
        }
        else
        {
            dd('Error change password');
        }
    }

////////////////////////////////tecaher password change////////////////////////////////
    public function changepasswordTeacher(Request $request)
    {
        if($request['password']==$request['password_c'])
        {
            $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);

            if($user)
            {
               return redirect('teacher/dashboard');
            }
        }
        else
        {
            dd('Error change password');
        }
    }

//////////////////// Edit teacher -- admin panel ////////////////////////////
    public function update(Request $request)
    {
        $request->validate(['name'=>'required', 'email'=>'required|unique:users,email']);
        $update = User::where('id',$request['id'])->update([
            'name'=> $request['name'],
            'email'=> $request['email']
        ]);
        if($update)
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return dd('Error while updating');
        }

    }

    /////////////////////  add teacher --admin panel //////////////////////////
    public function adduser(Request $request)
    {
        $creds = $request->validate([
            'name'=>'required',
            'email'=>'required|unique:users,email',
        ]);
        $cred = $creds;
        $cred['role']='teacher';
        $cred['password']= bcrypt('password');
        $add = User::create($cred);
        if($add)
        {
            return redirect('admin/dashboard');
        }
        else
        {
            return dd('Error while adding user');
        }

    }
    public function delete(Request $request)
    {
        $del = User::find($request->id)->delete();
        return redirect('admin/dashboard');
    }



/////////////////////////////////////////////API////////////////////////////////////////////



///////////// login ///////////////////
public function apilogin(Request $request)
{
     //credentials validation
    $login = $request->validate([
    'email'=>'required',
    'password'=>'required',
    ]);
    $cred = $request->all();
    //login attempt
    if(Auth::attempt($cred))
    {
       $user = Auth::user();
       if($user['role']=='admin')
       {
        $token = $user->createToken('authToken')->plainTextToken;
        $user = Auth::user();
        $teachers = user::all()->where('role','teacher');
        return response()->json([
            'user'=>$user,
            'token'=>$token,
            'teachers'=>$teachers,

        ]);

       }
       elseif($user['role']=='teacher')
       {
        $data= Auth::user();
        $total = count(DB::table('students')->get());
        $tenth = count(DB::table('students')->where('class','10th')->get());
        $twelve = count(DB::table('students')->where('class','12th')->get());
        $token = $user->createToken('authToken')->plainTextToken;
        return response()->json([
            'user'=>$data,
            'total'=>$total,
            '10th'=>$tenth,
            '12th'=>$twelve,
            'token'=> $token
        ]);

       }

    }
     else
    {
         return response()->json([
            'message'=>'Invalid Credentials'
            ]);
    }
}

///////  staff change password////////////
public function apichange(Request $request)
{
    $request->validate([
        'password'=>'required',
        'password_c'=>'required',
    ]);
    if($request['password']==$request['password_c'])
    {
        $user = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->password)]);
        if($user)
        {
            return response()->json([
                'message'=> 'Password changed successfully'
            ]);
        }
        else
        {
            return response()->json([
                'message'=>'password change Unseccessful'
            ]);
        }
    }


}


//////create teacher//////
public function createteacher(Request $request)
{
    if(Auth::user()->role == 'admin')
    {
    $teacher = $request->validate([
        'name'=>'required',
        'email'=>'required|unique:users,email,',
    ]);
    $teacher['role'] = 'teacher';
    $teacher['password']= hash::make('password');
    $created = user::create($teacher);
    if($created)
    {
        return response()->json([
            'message'=> 'Teacher added successfully',
        ]);
    }
    else
    {
        return response()->json([
            'message'=>'Error while adding teacher'
        ]);
    }
    }
    else
    {
        return response()->json([
            'message'=> 'unauthorized'
        ]);
    }
}

////////////////////  Edit teacher -- admin panel  ///////////////////////////
public function editteacher(Request $request)
{
    $edit = $request->validate([
        'name'=> 'required',
        'email'=>'required|unique:users,email'
    ]);


}



}  ///end of file
