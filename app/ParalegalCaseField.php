<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;

class ParalegalCaseField extends Model
{
    protected $table = 'paralegalCaseField';

    protected $fillable = ['id','name'];

    public function cases()
    {
        $this->hasMany(ParalegalCase::class);
    }
}
