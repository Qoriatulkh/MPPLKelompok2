<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;
use App\ParalegalCaseType;
use App\ParalegalCaseField;

class ParalegalCase extends Model
{
    protected $table = 'paralegal_cases';

    protected $fillable = ['id', 'paralegal_id', 'type_id', 'field_id', 'desc'];

    public function paralegal()
    {
        $this->belongsTo(Paralegal::class);
    }

    public function type()
    {
        $this->belongsTo(ParalegalCaseType::class);
    }

    public function field()
    {
        $this->belongsTo(ParalegalCaseField::class);
    }
}
