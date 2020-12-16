<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    const ROLE_ADMIN = 1;
    const ROLE_PARALEGAL = 2;

    protected $table = 'role';

    protected $fillable = ['id', 'name'];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
