<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chuongTrinhDaoTao extends Model
{
    protected $fillable = [
        'ten'
    ];

    protected $table = 'chuong-trinh-dao-tao';

    public function monHoc()
    {
        return $this->hasMany(monHoc::class, 'ctdt_id', 'id');
    }
}
