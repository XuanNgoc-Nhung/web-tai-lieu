<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class thongBao extends Model
{
    protected $fillable = [
        'tieu_de','mo_ta','noi_dung'
    ];
    protected $table = 'thong-bao';
}
