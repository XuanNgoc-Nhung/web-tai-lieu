<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function getHome()
    {
        return view('admin.home');
    }

    public function getChuongTrinhDaoTao()
    {
        return view('admin.chuong-trinh-dao-tao');
    }

    public function getMonHoc()
    {
        return view('admin.chuong-trinh-dao-tao');
    }

    public function getTaiLieu()
    {
        return view('admin.chuong-trinh-dao-tao');
    }
}
