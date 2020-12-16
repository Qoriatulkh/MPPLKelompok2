<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;

class ParalegalCaseField extends Model
{
    protected $table = 'paralegalCaseField';

    protected $fillable = ['id', 'name'];

    public function cases()
    {
        return $this->hasMany(ParalegalCase::class, 'field_id', 'id');
    }
}
