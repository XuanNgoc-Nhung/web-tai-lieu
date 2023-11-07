<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class monHoc extends Model
{
    protected $fillable = [
        'ten_mon','ctdt_id','ma_mon'
    ];
    protected $table = 'mon-hoc';
    public function chuongTrinhDaoTao(){
        return $this->hasOne(chuongTrinhDaoTao::class,'id','ctdt_id');
    }
}
