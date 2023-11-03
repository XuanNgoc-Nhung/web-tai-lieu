<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use App\monHoc;
use App\taiLieu;
use App\thongBao;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getHome(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $thong_bao = thongBao::all();
        $list_new = taiLieu::with('monHocChinh')->get();
        return view('user.home',compact(['list_new','list_ctdt','thong_bao']));
    }
    public function getThongBao(){
        $list_thong_bao = thongBao::all();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $tai_lieu_moi =  taiLieu::orderBy('created_at','DESC')->take(10)->get();
        $tai_lieu_lien_quan = taiLieu::inRandomOrder()->take(10)->get();
        return view('user.thong-bao',compact(['list_thong_bao','list_ctdt','tai_lieu_moi','tai_lieu_lien_quan']));
    }
    public function getTaiLieuTheoMon(Request $request){
        $req = $request->all();
        $list_tai_lieu = taiLieu::where('mon_hoc_chinh',$req['monHocId'])->get();
        $mon_hoc = monHoc::where('id',$req['monHocId'])->first();
        $list_tai_lieu_khac = taiLieu::where('mon_hoc_chinh','!=',$req['monHocId'])->get();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        return view('user.tai-lieu-theo-mon',compact(['list_ctdt','list_tai_lieu','list_tai_lieu_khac','mon_hoc']));
    }
    public function getChiTietTaiLieu(Request $request){
        $req = $request->all();
        $post = taiLieu::where('id',$req['postId'])->first();
        $post->luot_xem +=1;
        $post->save();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $tai_lieu_moi =  taiLieu::where('id','!=',$post->id)->orderBy('created_at','DESC')->take(10)->get();
        $tai_lieu_lien_quan = taiLieu::where('mon_hoc_chinh',$post->mon_hoc_chinh)->where('id','!=',$post->id)->get();
        return view('user.chi-tiet',compact(['list_ctdt','post','tai_lieu_lien_quan','tai_lieu_moi']));
    }
    public function chiTietThongBao(Request $request){
        $req = $request->all();
        $thong_bao = thongBao::where('id',$req['id'])->first();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $tai_lieu_moi =  taiLieu::orderBy('created_at','DESC')->take(10)->get();
        $thong_bao_khac = thongBao::where('id','!=',$req['id'])->get();
        $tai_lieu_lien_quan = taiLieu::inRandomOrder()->take(10)->get();
        return view('user.chi-tiet-thong-bao',compact(['thong_bao','list_ctdt','tai_lieu_moi','tai_lieu_lien_quan','thong_bao_khac']));
    }
    public function getTimKiemTaiLieu(Request $request){
        $req = $request->all();
        $tai_lieu_moi =  taiLieu::where('id','!=',0)->orderBy('created_at','DESC')->take(10)->get();
        $tai_lieu_lien_quan = taiLieu::where('id','!=',0)->get();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $list_tai_lieu = taiLieu::where('tag','like', '%' . $req['key'] . '%')->orWhere('ten_tai_lieu','like', '%' . $req['key'] . '%')->get();
        return view('user.tim-kiem',compact(['list_ctdt','list_tai_lieu','tai_lieu_moi','tai_lieu_lien_quan']));
    }
}
