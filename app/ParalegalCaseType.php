<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParalegalCaseType extends Model
{
    use SoftDeletes;

    protected $table = 'paralegalCaseTypes';

    protected $fillable = ['id', 'name'];

    public function cases()
    {
        return $this->hasMany(ParalegalCase::class, 'type_id', 'id');
    }
}
