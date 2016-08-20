<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Socialite;
use App\User;
use App\Socials;
use Auth;
class SocialController extends Controller
{
     /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        
        $user = Socialite::driver('facebook')->user();
        // dd($user);
        $social =Socials::where('provider_user_id',$user->id)->where('provider','facebook')->first();
        if($social){
            $u= User::where('email',$user->email)->first();
            Auth::login($u);
            return redirect('/');
        }else{
            $temp = new Socials;
            $temp->provider_user_id = $user->id;
            $temp->provider= 'facebook';
            $u = User::where('email',$user->email)->first();
            if(!$u){
                $u = User::create([
                    'name'=>$user->name,
                    'email'=>$user->email,
                    'avatar'=>$user->avatar,
                    'level'=>'2',
                    ]);

            }
            $temp->user_id= $u->id;
            $temp->avatar= $user->avatar;
            $temp->level='2';
            $temp->save();
            Auth::login($u);
            return redirect('/');
        }
    }

        /**
     * Redirect the user to the google authentication page.
     *
     * @return Response
     */
     public function redirectToProviderGoogle()
     {
            return Socialite::driver('google')->redirect();
     }

    /**
     * Obtain the user information from google.
     *
     * @return Response
     */
         public function handleProviderCallbackGoogle()
        {
        
            $user = Socialite::driver('google')->user();
            // dd($user);
            $social =Socials::where('provider_user_id',$user->id)->where('provider','google')->first();
            if($social){
                $u= User::where('email',$user->email)->first();
                Auth::login($u);
                return redirect('/');
            }else{
                $temp = new Socials;
                $temp->provider_user_id = $user->id;
                $temp->provider= 'google';
                $u = User::where('email',$user->email)->first();
                if(!$u){
                    $u = User::create([
                        'name'=>$user->name,
                        'email'=>$user->email,
                        'avatar'=>$user->avatar,
                        'level'=>'2'
                        ]);

                }
                $temp->user_id= $u->id;
                $temp->avatar= $user->avatar;
                $temp->level='2';
                $temp->save();
                Auth::login($u);
                return redirect('/');
        }
        // $user->token;
    }
}
// 929023425569-uli0h0hk0qi5luvr8vkhl2oje9p28763.apps.googleusercontent.com
// nK94V-ORlOwp4hOYPaNcF0ef