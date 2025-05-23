<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{   
    protected $fillable = [
        'filename', 'upload_name', 'uploaded_at'
    ];

    public $timestamps = false;
}
