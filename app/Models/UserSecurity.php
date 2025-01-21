<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSecurity extends Model
{
    protected $primaryKey = 'nik';
    public $incrementing = false; // Karena `kodeunik` bukan auto-increment
    //
    protected $fillable =['nik', 'nama', 'area'];
}
