<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Http\Requests\SignUpRequest;
use App\User;
use DateTime;

class SignUpController extends Controller
{
    public function getSignup(){
    	return view('signup');
    }
    public function postSignup(SignUpRequest $request){
        $user = new User;
        $file = $request->file('newsImg');
        $user->name = $request->txtName;
        $user->email =$request->txtMail;
        $user->password = bcrypt($request->txtPass);
        

        if(strlen($file)>0){
        	$fileName = time().'.'.$file->getClientOriginalName();
        	$destinationPath = 'public/uploads/news/';
        	$file ->move($destinationPath,$fileName);
        	$user ->avatar= $fileName;
        }
        $user->level ='2';
        $user->save();
    }

}
