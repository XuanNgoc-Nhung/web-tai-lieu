<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class monHoc extends Model
{
    protected $fillable = [
        'ten_mon','ctdt_id'
    ];
    protected $table = 'mon-hoc';
}
