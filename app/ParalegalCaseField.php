<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;
use Illuminate\Database\Eloquent\SoftDeletes;

class ParalegalCaseField extends Model
{
    use SoftDeletes;

    protected $table = 'paralegal_case_fields';

    protected $fillable = ['id', 'name'];

    public function cases()
    {
        return $this->hasMany(ParalegalCase::class, 'field_id', 'id');
    }
}
