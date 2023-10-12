<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getHome(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        return view('user.home',compact('list_ctdt'));
    }
    public function getTaiLieuTheoMon(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        return view('user.tai-lieu-theo-mon',compact('list_ctdt'));
    }
    public function getChiTietTaiLieu(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        return view('user.chi-tiet',compact('list_ctdt'));
    }
}
