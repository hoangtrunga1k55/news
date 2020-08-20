<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\TinTuc;
use App\LoaiTin;

class TinTucController extends Controller
{
    public function getDanhSach(){
        $theloai = TheLoai::all();
        $tintuc = TinTuc::all();
        return view('admin.tintuc.danhsach',['theloai'=>$theloai,'tintuc'=>$tintuc]);
    }

    public function getThem(){
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.them',['theloai'=>$theloai,'loaitin'=>$loaitin]);
    }
    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring = $characters[rand(0,60)];
        }
        return $randstring;
    }
    public function PostThem(Request  $request){
        $this->validate($request,
            [
                'tieude'=> 'required|min:3|unique:tintuc,Tieude',
                'loaitin'=>'required',
                'tomtat'=>'required',
                'noidung'=>'required'
            ],
            [
                'loaitin.required' => 'ban chua nhap loaitin',
                'tieude.min' =>' the loai phai lon hon 3 ky tu',
                'tieude.unique'=> 'Tieu de da ton tai',
                'tomtat.required'=> 'Ban chua nhap tom tat',
                'noidung.required'=> 'Ban chua nhap noi dung'
            ]
        );
        $tintuc = new TinTuc();
        $tintuc->TieuDe = $request->tieude;
        $tintuc->TieuDeKhongDau = changeTitle($request->tieude);
        $tintuc->idLoaiTin = $request->loaitin;
        $tintuc->TomTat = $request->tomtat;
        $tintuc->NoiDung = $request->noidung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('hinh')){
            $file = $request->file('hinh');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/tintuc/them')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("tintuc/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('tintuc',$Hinh);
                $tintuc->Hinh = $Hinh;
            }

        }else{
            $tintuc->Hinh = '';
        }
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $tintuc = TinTuc::find($id);
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.sua',['theloai'=>$theloai,'tt'=>$tintuc,'loaitin'=>$loaitin
        ]);

    }
    public function postSua(Request  $request,$id){
        $this->validate($request,
            [
                'tieude'=> 'required|min:3|',
                'loaitin'=>'required',
                'tomtat'=>'required',
                'noidung'=>'required'
            ],
            [
                'loaitin.required' => 'ban chua nhap loaitin',
                'tieude.min' =>' the loai phai lon hon 3 ky tu',
                'tomtat.required'=> 'Ban chua nhap tom tat',
                'noidung.required'=> 'Ban chua nhap noi dung'
            ]
        );
        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $request->tieude;
        $tintuc->TieuDeKhongDau = changeTitle($request->tieude);
        $tintuc->idLoaiTin = $request->loaitin;
      if ($request->hasFile('hinh')){
            $file = $request->file('hinh');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/tintuc/them')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("tintuc/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('tintuc',$Hinh);
                $tintuc->Hinh = $Hinh;
            }

        }else{
            $tintuc->Hinh = '';
        }    $tintuc->TomTat = $request->tomtat;
        $tintuc->NoiDung = $request->noidung;
        $tintuc->SoLuotXem = 0;
        if ($request->hasFile('hinh')){
            $file = $request->file('hinh');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/tintuc/them')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("tintuc/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('tintuc',$Hinh);
                $tintuc->Hinh = $Hinh;
            }

        }else{
            $tintuc->Hinh = '';
        }
        $tintuc->save();
        return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sua thanh cong');
    }

    public function postXoa($id){
        $tintuc = TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach/')->with('thongbao','xoa thanh cong');
    }
}
