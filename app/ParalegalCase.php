<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;
use App\ParalegalCaseType;
use App\ParalegalCaseField;
use Carbon\Carbon;

class ParalegalCase extends Model
{
    protected $table = 'paralegal_cases';

    protected $fillable = ['id', 'paralegal_id', 'type_id', 'field_id', 'desc', 'name', 'date', 'created_by', 'status_id'];

    protected $casts = [
        'date' => 'date'
    ];

    /**
     * Accessors
     */
    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->locale('id')->translatedFormat('d F Y');
    }

    public function paralegal()
    {
        return $this->belongsTo(Paralegal::class);
    }

    public function type()
    {
        return $this->belongsTo(ParalegalCaseType::class, 'type_id', 'id');
    }

    public function field()
    {
        return $this->belongsTo(ParalegalCaseField::class, 'field_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
}
