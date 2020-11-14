<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;

class ParalegalCaseType extends Model
{
    protected $table = 'paralegalCaseTypes';

    protected $fillable = ['id','name'];

    public function cases()
    {
        $this->hasMany(ParalegalCase::class);
    }
}
