<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParalegalCaseStatus extends Model
{
    const ONGOING = 1;
    const DONE = 2;
    const FAILED = 3;
    const UNKNOWN = 4;
    protected $fillable = ['name'];

    public static function toBadge($id)
    {
        switch ($id) {
            case self::ONGOING:
                return '<span class="badge badge-warning">On Going</span>';
                break;
            case self::DONE:
                return '<span class="badge badge-success">Selesai</span>';
                break;
            case self::FAILED:
                return '<span class="badge badge-danger">Gagal</span>';
                break;
            default:
                return '<span class="badge badge-dark">Tidak Diketahui</span>';
                break;
        }
    }
}
