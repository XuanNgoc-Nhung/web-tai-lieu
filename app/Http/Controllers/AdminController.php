<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use App\monHoc;
use App\taiLieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

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
        return view('admin.tai-lieu');
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

    public function suaMonHoc(Request $request)
    {
        $req = $request->all();
        $check = monHoc::where('id', $req['id'])->first();
        if ($check) {
            $check->ctdt_id = $req['ctdt_id'];
            $check->ten_mon = $req['ten_mon'];
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

    public function themTaiLieu(Request $request)
    {
        Log::info('Thêm tài liệu');
        $req = $request->all();
        $fileTaiLieu = null;
        $fileAnhBia = null;
        $slug = Str::slug($req['ten_tai_lieu']);
        Log::info('Slug là:');
        Log::info($slug);
        if ($request->file('tai_lieu')) {
            $taiLieu = $request->file('tai_lieu');
            $fileTaiLieu = '/files/taiLieu/' . $slug . '-' . uniqid() . '.' . $taiLieu->extension();
            $taiLieu->move(public_path('files/taiLieu'), $fileTaiLieu);
        }
        if ($request->file('anh_bia')) {
            $anhBia = $request->file('anh_bia');
            $fileAnhBia = '/files/anhBia/' . $slug . '-' . uniqid() . '.' . $anhBia->extension();
            $anhBia->move(public_path('files/anhBia'), $fileAnhBia);
        }

        $dataCreat = taiLieu::create([
            'mon_hoc_chinh' => $req['mon_hoc_chinh'],
            'mon_hoc_phu' => $req['mon_hoc_phu'],
            'ten_tai_lieu' => $req['ten_tai_lieu'],
            'tac_gia' => $req['tac_gia'],
            'tag' => $req['tag'],
            'mo_ta' => $req['mo_ta'],
            'noi_dung' => $req['noi_dung'],
            'link_file' => $fileTaiLieu,
            'hinh_anh' => $fileAnhBia,
        ]);
        $res = [
            'rc' => '0',
            'data' => $dataCreat,
            'rd' => 'Đăng ký khoản vay thành công',
        ];
        return json_encode($res);
    }

    public function xoaChuongTrinhDaoTao(Request $request)
    {
        $req = $request->all();
        $check = chuongTrinhDaoTao::where('id', $req['id'])->first();
        $tai_lieu = chuongTrinhDaoTao::all();
        if (count($tai_lieu)) {
            $res = [
                'rc' => '-1',
                'rd' => 'Môn học đang có tài liệu, không thể xóa.'
            ];
        } else {
            if ($check) {
                $check->delete();
                $res = [
                    'rc' => 0,
                    'rd' => 'Đã xóa thành công.',
                    'data' => null
                ];

            } else {
                $res = [
                    'rc' => '-1',
                    'rd' => 'Không tìm thấy dữ  liệu cần xoá'
                ];
            }
        }
        return json_encode($res);
    }
    public function xoaMonHoc(Request $request)
    {
        $req = $request->all();
        $check = monHoc::where('id', $req['id'])->first();
        $tai_lieu = chuongTrinhDaoTao::all();
        if (count($tai_lieu)) {
            $res = [
                'rc' => '-1',
                'rd' => 'Môn học đang có tài liệu, không thể xóa.'
            ];
        } else {
            if ($check) {
                $check->delete();
                $res = [
                    'rc' => 0,
                    'rd' => 'Đã xóa thành công.',
                    'data' => null
                ];

            } else {
                $res = [
                    'rc' => '-1',
                    'rd' => 'Không tìm thấy dữ  liệu cần xoá'
                ];
            }
        }
        return json_encode($res);
    }

    public function xoaTaiLieu(Request $request)
    {
        $req = $request->all();
        $check = taiLieu::where('id', $req['id'])->first();
        if ($check) {
            $check->delete();
            $res = [
                'rc' => 0,
                'rd' => 'Đã xóa thành công.',
                'data' => null
            ];

        } else {
            $res = [
                'rc' => '-1',
                'rd' => 'Không tìm thấy dữ  liệu cần xoá'
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

    public function layDanhSachMonHoc(Request $request)
    {
        $req = $request->all();
        $list = monHoc::where('id', '>', 0);
        if (isset($req['ctdt']) && $req['ctdt'] != '') {
            $list = monHoc::where('ctdt_id', $req['ctdt']);
        }
        $total = $list->count();
        $data = $list->with('chuongTrinhDaoTao')->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
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

    public function layDanhSachTaiLieu(Request $request)
    {

        $req = $request->all();
        $list = taiLieu::where('ten_tai_lieu', 'like', '%' . $req['key'] . '%');
//        if (isset($req['ctdt'])&&$req['ctdt']!=''){
//            $list = monHoc::where('ctdt_id',$req['ctdt']);
//        }
        $total = $list->count();
        $data = $list->with('monHocChinh.chuongTrinhDaoTao')->with('monHocChinh')->with('monHocPhu')->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
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
}
