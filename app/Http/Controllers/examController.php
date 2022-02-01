<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tenth;
use App\Models\twelve;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\countOf;

class examController extends Controller
{
    public function index(Request $request)
    {
        if(session()->has('teacher'))
        {
        return view('teacher/addqns',['qns'=>$request['qns'],'class'=>$request['class']]);
        }
        else
        {
            return redirect('welcome');
        }

    }
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
        DB::table('attempts')->where('class',$request['class'])->update(['attempts'=>'0']);
        return redirect('teacher/dashboard');

    }


    public function test()
    {
        if(session()->has('student'))
        {
        if(session('class')=='10th')
            $class = 'tenth';
        if(session('class')=='12th')
            $class = 'twelve';

            $test = DB::table($class)->get();
            $attempt = DB::table('attempts')->where('class',session('class'))->where('rollno',session('rollno'))->get();
            foreach($attempt as $attempts)
            {
             $attempted = $attempts->attempts;
            }
            if($attempted!=='0')
            {
                return view('already');
            }
            else
            {
                return view('test',['test'=>$test,'class'=>$class]);

            }
        }
        else
        {
            return redirect('/');
        }
    }



    public function submittest(Request $request)
    {
        //return $request;

        $answers = DB::table($request['class'])->pluck('ans')->toArray();
        $true = [];
        $false=[];

        for($x=0;$x<$request['no'];$x++)
        {
            //echo $request['ans'.+$x+1];

            // echo $answers[$x];
        if($request['ans'.+$x+1] == $answers[$x])
            {
                echo '1';
                $true[] = '1';
            }
            else
            {
                $false[] = '0';
            }
        }
        if(DB::table('results')->insert([
            'rollno'=> session('rollno'),
            'class'=> $request['class'],
            'correct'=>count($true),
            'wrong'=>count($false),
            'total'=>$request['no'],
        ]))
        {   DB::table('attempts')->where('rollno',session('rollno'))->where('class',session('class'))->update(['attempts'=>1]);
            return redirect('studentdashboard');
        }



    }
}
