<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Socials extends Model
{
    //
    protected $table ='uet_socials';
      protected $fillable = [
        'user_id', 'provider_user_id', 'level', 'provider','avatar',
    ];
    public function users(){
    	$this->belongTo(User::class);
    }
}
