<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParalegalCaseType extends Model
{
    // Fillable mass assign
    protected $fillable = ['name'];

    /**
     * Relations
     */
    public function cases()
    {
        return $this->hasMany(ParalegalCase::class, 'paralegal_case_type_id', 'id');
    }
}
