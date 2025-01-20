<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointQR extends Model
{
    protected $fillable = ['kodeunik', 'nama_tempat', 'area', 'latitude', 'longitude', 'keterangan'];
    // Setting the primary key to 'kodeunik' because it uniquely identifies each record in the PointQR table
    protected $primaryKey = 'kodeunik';
    public $incrementing = false; // Karena `kodeunik` bukan auto-increment
    protected $keyType = 'char'; // Tipe data primary key (char/string)

    public function security()
    {
        return $this->hasMany(Security::class);
    }
}
