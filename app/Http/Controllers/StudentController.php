<?php

namespace App\Http\Controllers;

use App\Models\student;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\ConsoleOutput;
use Illuminate\Support\Facades\DB;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      #  return view('login'); # retrun login blade.php page 
      $student_all= DB::table('students')->get();
      return view('studentlist',compact('student_all'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        student::create($request->all());
        #compacting the variable $msg_login with value 'here your are' 
        #sending data using array to html page 
        return view('login',['msg_login'=>'Here you are::::']);
        


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(student $student)
    {
        $student_all= DB::table('students')->get();
        return view('studentlist',compact('student_all'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(student $student)
    {
       
    }
    #custom method 
    //verify  the student 
    public function check(Request $request, student $student)
    {
        $user = DB::table('students')->where('email',$request->email)->first();

       # return $user->password;
       $msg_login = 'Not regsistred';
        if(is_null($user)){
            return view('login',compact('msg_login'));
        }
        else{
           if($user->password==$request->password){
           # return $user->name;
           if($user->password=='admin'){
            
            $student_all= DB::table('students')->get();
            return view('studentlist',compact('student_all'));

           }
           else
           {
            return view('userpage',compact('user'));

           }
            
           }
           else{
            $msg_login='!!Wrong email or password';
            return view('login',compact('msg_login'));
           }
        }
 
        
    }

    #delete the student

    public function delete($id) {
      #  $deleted = DB::table('users')->delete();
      $deleted = DB::table('students')->where('id', '=',$id)->delete();
      return redirect(route('student.show'));


     }
}
