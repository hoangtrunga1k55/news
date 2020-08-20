<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        return view('admin.theloai.danhsach',['theloai'=>$theloai]);
    }

    public function getThem(){
        return view('admin.theloai.them');
    }

    public function PostThem(Request  $request){
        $this->validate($request,
        [
            'Ten'=> 'required|min:3|max:100'
        ],
            [
                'Ten.required' => 'ban chua nhap ten',
                'Ten.min' =>' the loai phai lon hon 3 ky tu',
                'Ten.max'=> 'the loai nho hon 100 ky tu'
            ]
        );
        $theloai = new TheLoai();
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $theloai = TheLoai::find($id);
        return view('admin.theloai.sua',['theloai'=>$theloai
        ]);

    }
    public function postSua(Request  $request,$id){
        $theloai = TheLoai::find($id);
        $this->validate($request,
        [
            'Ten' => 'required|unique:theloai,Ten|min:3|max:100'
        ],
            [
                'Ten.required' => 'ban chua nhap ten',
                'Ten.unique'=>'Ten the loai da ton tai',
                'Ten.min' =>' the loai phai lon hon 3 ky tu',
                'Ten.max'=> 'the loai nho hon 100 ky tu'
            ]
        );
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function postXoa($id){
        $theloai = TheLoai::find($id);
        $theloai->delete();
        return redirect('admin/theloai/danhsach/')->with('thongbao','xoa thanh cong');
    }
}
