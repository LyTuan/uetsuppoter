<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tuition extends Model
{
    protected $table = 'tuition';
	protected $fillable=[
        'title',
        'link'
    ];
}
