<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Crypt;
use Hash;

class LoginAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user = User::all();
        return response($user,201);

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
     * Check password and email return 1 if have an user and return 0  have no user
     * 
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user= User::where('email',($request->txtMail))->get()->toArray();
        
        if($user!=null){
      
            if(Hash::check($request->txtPass, $user['0']['password'])){
                return 1;
            }else{
                return 0;
              }
        }else{
            return 0;    
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user=User::find($id);
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = new User;
        $findUserEmail = User::where('email',$request->txtMail)->get()->toArray();
        $findUserName = User::where('name',$request->txtName)->get()->toArray();
        if($findUserEmail==null){
                $user->email=$request->txtMail;
            $user->password=$request->txtPass;
            $user->level='2';
            $user->name=$request->txtName;
            $user->save();
            return 1;    
        }else{
            return 0;
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user= User::find($id);
        $user->delete();
    }
}
