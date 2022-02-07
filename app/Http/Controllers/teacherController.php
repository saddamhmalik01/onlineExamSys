<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\student;

class teacherController extends Controller
{
    public function index()
    {
        if(session()->has('teacher'))
        {
        $data= Auth::user();
        $total = count(student::get());
        $tenth = count(student::where('class','10th')->get());
        $twelve = count(student::where('class','12th')->get());
        return view('teacher/dashboard',['data'=>$data,'total'=> $total,'ten'=>$tenth,'twelve'=>$twelve]);
        }
         return redirect('/');
    }

    public function edit(Request $request)
    {
    if(session()->has('admin'))
        {
        $user = User::find($request->id);
        return view('admin/edit',['user'=>$user]);
        }
    return redirect('/');
    }
}
