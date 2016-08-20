<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    //

    public function getListUser(){
    	$user = User::all();
    	return view('admin.user.list',['data_user'=>$user]);
    }
    public function getAddUser(){

    }
    public function getUserDel($id){
    	$user = User::find($id);
    	if($user->level!=1){
    		$user->delete();
    		return redirect('uet_admin/user/list');		
    	}else{
    		echo "<script type='text/javascript'>
    			alert('Xin lỗi. Bạn không được phép xóa');";
    		echo "'</script>";

    	}
    	
    }
}
