<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $table = 'role';

    protected $fillable = ['id','name'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}