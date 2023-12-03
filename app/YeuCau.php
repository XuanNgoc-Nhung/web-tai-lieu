<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YeuCau extends Model
{
    protected $fillable = [
        'tieu_de','user_id','noi_dung','trang_thai'
    ];
    protected $table = 'yeu-cau';

    public function nguoiTao(){
        return $this->hasOne(User::class,'id','user_id');
    }
}
