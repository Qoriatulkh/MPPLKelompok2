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

    public function area()
    {
        $this->belongsTo(Area::class);
    }

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function cases()
    {
        $this->hasMany(ParalegalCase::class);
    }
}
