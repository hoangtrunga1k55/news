<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\LoaiTin;

class LoaiTinController extends Controller
{
    public function getDanhSach(){
        $LoaiTin = LoaiTin::all();
        return view('admin.loaitin.danhsach',['LoaiTin'=>$LoaiTin]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        return view('admin.loaitin.them',['TheLoai'=>$theloai]);
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
        $LoaiTin = new LoaiTin();
        $LoaiTin->Ten = $request->Ten;
        $LoaiTin->TenKhongDau = changeTitle($request->Ten);
        $LoaiTin->idTheLoai = $request->TheLoai;
        $LoaiTin->save();
        return redirect('admin/loaitin/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $LoaiTin = LoaiTin::find($id);
        $theloai = TheLoai::all();
        return view('admin.loaitin.sua',['LoaiTin'=>$LoaiTin,'TheLoai'=>$theloai
        ]);

    }
    public function postSua(Request  $request,$id){
        $LoaiTin = LoaiTin::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'ban chua nhap ten',
                'Ten.unique'=>'Ten the loai da ton tai',
                'Ten.min' =>' the loai phai lon hon 3 ky tu',
                'Ten.max'=> 'the loai nho hon 100 ky tu'
            ]
        );
        $LoaiTin->Ten = $request->Ten;
        $LoaiTin->TenKhongDau = changeTitle($request->Ten);
        $LoaiTin->save();
        return redirect('admin/loaitin/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function postXoa($id){
        $LoaiTin = LoaiTin::find($id);
        $LoaiTin->delete();
        return redirect('admin/loaitin/danhsach/')->with('thongbao','xoa thanh cong');
    }
}
