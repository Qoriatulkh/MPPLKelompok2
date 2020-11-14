<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Paralegal;

class Area extends Model
{
    protected $table = 'areas';

    protected $fillable = ['id', 'code','region_name','region_code','province_name','province_code',
    'city_name','city_code','district_name','district_code','village_name','village_code'];

    public function paralegal(){
        $this->hasMany(Paralegal::class);
    }
  
}
