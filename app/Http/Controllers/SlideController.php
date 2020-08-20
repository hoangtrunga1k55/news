<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    public function RandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';
        for ($i = 0; $i < $length; $i++) {
            $randstring = $characters[rand(0,60)];
        }
        return $randstring;
    }

    public function getDanhSach(){
        $slide = Slide::all();
        return view('admin.slide.danhsach',['slide'=>$slide]);
    }

    public function getThem(){
        $slide = Slide::all();
        return view('admin.slide.them',['slide'=>$slide]);
    }

    public function PostThem(Request  $request){
        $this->validate($request,
            [
                'Ten'=> 'required|min:3|max:100'
            ],
            [
                'Ten.required' => 'ban chua nhap ten',
                'Ten.min' =>' the loai phai lon hon 3 ky tu',
            ]
        );
        $slide = new Slide();
        $slide->Ten = $request->Ten;
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/slide/them')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("slide/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('slide',$Hinh);
                $slide->Hinh = $Hinh;
            }

        }else{
            $slide->Hinh = '';
        }
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link')){
            $slide->link = $request->link;
        }
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $slide = Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);

    }
    public function postSua(Request  $request,$id){
        $slide = Slide::find($id);
        $this->validate($request,
            [
                'Ten' => 'required|unique:loaitin,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'ban chua nhap ten',
                'Ten.unique'=>'Ten the loai da ton tai',
                'Ten.min' =>' the loai phai lon hon 3 ky tu',
            ]
        );
        $slide->Ten = $request->Ten;
        if ($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            if ($file->getClientOriginalExtension()!='jpg'&&$file->getClientOriginalExtension()!='png'){
                return redirect('admin/slide/them')->with('loi','ban chi duoc nhap file anh');
            }
            else{
                $name = $file->getClientOriginalName();
                $Hinh = $this->RandomString(4)."_".$name;
                while (file_exists("slide/".$Hinh)){
                    $Hinh = $this->RandomString(4)."_".$Hinh;
                }
                $file->move('slide',$Hinh);
                $slide->Hinh = $Hinh;
            }

        }else{
            $slide->Hinh = '';
        }
        $slide->NoiDung = $request->NoiDung;
        if ($request->has('link')){
            $slide->link = $request->link;
        }
        $slide->save();
        return redirect('admin/slide/danhsach')->with('thongbao','Sua thanh cong');
    }

    public function postXoa($id){
        $slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach/')->with('thongbao','xoa thanh cong');
    }
}
