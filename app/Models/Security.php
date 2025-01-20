<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Security extends Model
{
    protected $fillable = ['nama', 'nik', 'latitude', 'longitude', 'status', 'kodeunik', 'jarak', 'keterangan'];

    public function pointqr()
    {
        return $this->belongsTo(PointQR::class, 'kodeunik', 'kodeunik');
    }
}
