<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use App\monHoc;
use App\taiLieu;
use App\thongBao;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Hash;

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

    public function getThongBao()
    {
        return view('admin.thong-bao');
    }
    public function getUser()
    {
        return view('admin.nguoi-dung');
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

    public function suaTaiLieu(Request $request)
    {

        $req = $request->all();
        $check = taiLieu::where('id', $req['id'])->first();
        $slug = Str::slug($req['ten_tai_lieu']);
        if ($check) {
            $check->mon_hoc_chinh = $req['mon_hoc_chinh'];
            $check->mon_hoc_phu = $req['mon_hoc_phu'];
            $check->ten_tai_lieu = $req['ten_tai_lieu'];
            $check->tac_gia = $req['tac_gia'];
            $check->tag = $req['tag'];
            $check->loai = $req['loai'];
            $check->mo_ta = $req['mo_ta'];
            $check->noi_dung = $req['noi_dung'];
            $check->trang_thai = $req['trang_thai'];
            if ($request->file('tai_lieu')) {
                $taiLieu = $request->file('tai_lieu');
                $fileTaiLieu = '/files/taiLieu/' . $slug . '-' . uniqid() . '.' . $taiLieu->extension();
                $taiLieu->move(public_path('files/taiLieu'), $fileTaiLieu);
                $check->link_file = $fileTaiLieu;
            }
            if ($request->file('anh_bia')) {
                $anhBia = $request->file('anh_bia');
                $fileAnhBia = '/files/anhBia/' . $slug . '-' . uniqid() . '.' . $anhBia->extension();
                $anhBia->move(public_path('files/anhBia'), $fileAnhBia);
                $check->hinh_anh = $fileAnhBia;
            }
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
            $check->ma_mon = $req['ma_mon'];
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


    public function suaThongBao(Request $request)
    {
        $req = $request->all();
        $check = thongBao::where('id', $req['id'])->first();
        if ($check) {
            $check->tieu_de = $req['tieu_de'];
            $check->mo_ta = $req['mo_ta'];
            $check->noi_dung = $req['noi_dung'];
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
    public function suaNguoiDung(Request $request)
    {
        $req = $request->all();
        $check = User::where('id', $req['id'])->first();
        if ($check) {
            $check->phone = $req['phone'];
            $check->name = $req['name'];
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
        $check = monHoc::where('ten_mon', $req['ten'])->orWhere('ma_mon', $req['ma_mon'])->first();
        if ($check) {
            $res = [
                'rc' => -1,
                'rd' => 'Học phần đã tồn tại.',
                'data' => null
            ];

        } else {
            $dataCreat = monHoc::create([
                'ten_mon' => $req['ten'],
                'ctdt_id' => $req['ctdt'],
                'ma_mon' => $req['ma_mon'],
            ]);
            $res = [
                'rc' => 0,
                'rd' => 'Thêm dữ liệu thành công.',
                'data' => $dataCreat
            ];
        }
        return json_encode($res);
    }
    public function themNguoiDung(Request $request)
    {
        $req = $request->all();
        $check = User::where('email', $req['email'])->orWhere('ma_sv', $req['ma_sv'])->first();
        if ($check) {
            $res = [
                'rc' => -1,
                'rd' => 'Email hoặc mã người dùng đã tồn tại.',
                'data' => null
            ];
        } else {
            $dataCreat = User::create([
                'phone' => $req['phone'],
                'email' => $req['email'],
                'name' => $req['name'],
                'ma_sv' => $req['ma_sv'],
                'password' => Hash::make($req['pass'])
            ]);
            $res = [
                'rc' => 0,
                'rd' => 'Thêm dữ liệu thành công.',
                'data' => $dataCreat
            ];
        }
        return json_encode($res);
    }
    public function themThongBao(Request $request)
    {
        $req = $request->all();
        $check = thongBao::where('tieu_de', $req['tieu_de'])->first();
        if ($check) {
            $res = [
                'rc' => -1,
                'rd' => 'Thông báo đã tồn tại.',
                'data' => null
            ];

        } else {
            $dataCreat = thongBao::create([
                'tieu_de' => $req['tieu_de'],
                'noi_dung' => $req['noi_dung'],
                'mo_ta' => $req['mo_ta'],
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
            'link_file' => $fileTaiLieu ? $fileTaiLieu : '/404',
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
        $check_mon_hoc = monHoc::where('ctdt_id', 'like', '%' . $req['id'] . '%')->first();
        if (isset($check_mon_hoc)) {
            $res = [
                'rc' => '-1',
                'rd' => 'Chương trình đào tạo đang có môn học. Không thể xóa. [' . $check_mon_hoc['ten_mon'] . ']'
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
        $tai_lieu = taiLieu::where('mon_hoc_chinh',$req['id'])->get();
        if (count($tai_lieu)) {
            $res = [
                'rc' => '-1',
                'rd' => 'Học phần đang có tài liệu, không thể xóa.'
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

    public function xoaThongBao(Request $request)
    {
        $req = $request->all();
        $check = thongBao::where('id', $req['id'])->first();
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
    public function xoaNguoiDung(Request $request)
    {
        $req = $request->all();
        $check = User::where('id', $req['id'])->first();
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
            $list = monHoc::where('ctdt_id', 'like', '%' . $req['ctdt'] . '%');
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
    public function layDanhSachNguoiDung(Request $request)
    {
        $req = $request->all();
        $list = User::where('role', '=', 0);
        if (isset($req['key']) && $req['key'] != '') {
            $list = User::where('email', 'like', '%' . $req['key'] . '%');
        }
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
    public function layDanhSachThongBao(Request $request)
    {
        $req = $request->all();
        $list = thongBao::where('id', '>', 0);
        if (isset($req['key']) && $req['key'] != '') {
            $list = thongBao::where('tieu_de', 'like', '%' . $req['key'] . '%');
        }
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

    public function layDanhSachTaiLieu(Request $request)
    {

        $req = $request->all();
        $list = taiLieu::where('ten_tai_lieu', 'like', '%' . $req['key'] . '%');
//        if (isset($req['ctdt'])&&$req['ctdt']!=''){
//            $list = monHoc::where('ctdt_id',$req['ctdt']);
//        }
        $total = $list->count();
        $data = $list->with('monHocChinh.chuongTrinhDaoTao')->with('monHocChinh')->orderBy('created_at', 'DESC')->skip($req['start'])->take($req['limit'])->get();
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
