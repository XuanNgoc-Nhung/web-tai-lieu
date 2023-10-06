<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use App\monHoc;
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
        return view('admin.mon-hoc');
    }

    public function getTaiLieu()
    {
        return view('admin.chuong-trinh-dao-tao');
    }

    public function suaChuongTrinhDaoTao(Request $request)
    {
        $req = $request->all();
        $check = chuongTrinhDaoTao::where('id', $req['id'])->first();
        if ($check) {
            $check->ten = $req['ten'];
            $check->save();
            $res = [
                'rc' => 0,
                'rd' => 'Cập nhật thành công',
                'data' => $check
            ];
        } else {
            $res = [
                'rc' => -1,
                'rd' => 'Không tìm thấy dữ liệu',
                'data' => null
            ];
        }
        return json_encode($res);
    }

    public function themChuongTrinhDaoTao(Request $request)
    {
        $req = $request->all();
        $check = chuongTrinhDaoTao::where('ten', $req['ten'])->first();
        if ($check) {
            $res = [
                'rc' => -1,
                'rd' => 'Chương trình đào tạo đã tồn tại.',
                'data' => null
            ];

        } else {
            $dataCreat = chuongTrinhDaoTao::create([
                'ten' => $req['ten'],
            ]);
            $res = [
                'rc' => 0,
                'rd' => 'Thêm dữ liệu thành công.',
                'data' => $dataCreat
            ];
        }
        return json_encode($res);
    }

    public function themMonHoc(Request $request)
    {
        $req = $request->all();
        $check = monHoc::where('ten_mon', $req['ten'])->first();
        if ($check) {
            $res = [
                'rc' => -1,
                'rd' => 'Môn học đã tồn tại.',
                'data' => null
            ];

        } else {
            $dataCreat = monHoc::create([
                'ten_mon' => $req['ten'],
                'ctdt_id' => $req['ctdt'],
            ]);
            $res = [
                'rc' => 0,
                'rd' => 'Thêm dữ liệu thành công.',
                'data' => $dataCreat
            ];
        }
        return json_encode($res);
    }

    public function layDanhSachChuongTrinhDaoTao(Request $request)
    {

        $req = $request->all();
        $list = chuongTrinhDaoTao::where('id', '>', 0);
        $total = $list->count();
        $data = $list->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
        if (count($data)) {
            $res = [
                'rc' => '0',
                'data' => $data,
                'total' => $total
            ];
        } else {
            $res = [
                'rc' => '1',
                'rd' => 'Không tìm thấy bản ghi nào'
            ];
        }
        return json_encode($res);
    }
    public function layDanhSachMonHoc(){
        
    }
}
