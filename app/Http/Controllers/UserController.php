<?php

namespace App\Http\Controllers;

use App\chuongTrinhDaoTao;
use App\taiLieu;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function getHome(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $list_new = taiLieu::with('monHocChinh')->get();
        return view('user.home',compact(['list_new','list_ctdt']));
    }
    public function getTaiLieuTheoMon(){
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        return view('user.tai-lieu-theo-mon',compact('list_ctdt'));
    }
    public function getChiTietTaiLieu(Request $request){
        $req = $request->all();
        $post = taiLieu::where('id',$req['postId'])->first();
        $list_ctdt = chuongTrinhDaoTao::with('monHoc')->get();
        $tai_lieu_moi =  taiLieu::where('id','!=',$post->id)->orderBy('created_at','DESC')->take(10)->get();
        $tai_lieu_lien_quan = taiLieu::where('mon_hoc_chinh',$post->mon_hoc_chinh)->where('id','!=',$post->id)->get();
        return view('user.chi-tiet',compact(['list_ctdt','post','tai_lieu_lien_quan','tai_lieu_moi']));
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
