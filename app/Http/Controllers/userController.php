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






    public function update(Request $request)
    {
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
}
