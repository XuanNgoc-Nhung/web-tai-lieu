<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class taiLieu extends Model
{

    protected $fillable = [
        'ten_tai_lieu','link_file','mo_ta','noi_dung','tag','mon_hoc_chinh','mon_hoc_phu','hinh_anh','luot_xem','tac_gia'
    ];
    protected $table = 'tai-lieu';
}