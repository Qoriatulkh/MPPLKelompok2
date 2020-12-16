<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Area;
use App\User;
use App\PararegalCase;

class Paralegal extends Model
{
    protected $table = 'paralegals';

    protected $fillable = [
        'id', 'user_id', 'area_id', 'number', 'name', 'address',
        'sex', 'isApproved', 'phoneNumber'
    ];

    /**
     * Accessors
     */
    public function getAlteredSexAttribute()
    {
        return $this->attributes['sex'] == 'Male' ? 'L' : 'P';
    }

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cases()
    {
        return $this->hasMany(ParalegalCase::class);
    }
}
