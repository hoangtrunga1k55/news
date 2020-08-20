<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\TheLoai;
use App\Slide;
use App\LoaiTin;
use App\TinTuc;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    function __construct()
    {
        $theloai = TheLoai::all();
        $slide = Slide::all();
        $loaitin = LoaiTin::all();
        view()->share('theloai', $theloai);
        view()->share('slide', $slide);
        view()->share('loaitin', $loaitin);
    }

    public function TrangChu()
    {
        return view('pages.trangchu');
    }

    public function LienHe()
    {
        return view('pages.lienhe');
    }

    public function LoaiTin($id)
    {
        $loaitin = LoaiTin::find($id);
        $tintuc = TinTuc::where('idLoaiTin', $id)->paginate(5);
        return view('pages.loaitin', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }

    public function TinTuc($id)
    {
        $tintuc = TinTuc::find($id);
        $tinNB = TinTuc::where('NoiBat', 1)->take(4)->get();
        $tinLq = TinTuc::where('idLoaiTin', @$tintuc->idLoaiTin)->take(4)->get();
        return view('pages.tintuc', ['tintuc' => $tintuc, 'tinNB' => $tinNB, 'tinLq' => $tinLq]);
    }

    public function getDangNhap()
    {
        return view('pages.dangnhap');
    }

    public function postDangNhap(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required|min:3|max:32',
            ], [
                'email.required' => 'ban chua nhap email',
                'password.required' => 'ban chua nhap password',
                'password.min' => 'password min la 3',
                'password.max' => 'password max la 32'
            ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('trangchu');
        } else {
            return redirect('login')->with('thongbao', 'dang nhap khong thanh cong');
        }
    }

    public function getDangXuat()
    {
        Auth::logout();
        return redirect('trangchu');
    }

    public function getNguoiDung()
    {
        if(Auth::check()){
            $user = Auth::user();
            return view('pages.nguoidung', ['user' => $user]);
        }
        else{
            return redirect('login');
        }
    }

    public function postNguoiDung(Request $request)
    {
        $this->validate($request,
            [
                'name'=> 'required|min:3|max:30',
                'email'=> 'required|min:8|max:25',
            ],
            [
                'name.required' => 'ban chua nhap ten',
                'name.min' =>' name phai lon hon 3 ky tu',
                'name.max' =>' name phai nho hon 30 ky tu',
                'email.required' => 'ban chua nhap ten',
                'email.min' =>' email phai lon hon 3 ky tu',
                'email.max' =>' email phai nho hon 20 ky tu',
            ]
        );
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->checkpassword){
            $this->validate($request,
                [
                    'password'=> 'required|min:8|max:20',
                    'passwordAgain' =>'required|same:password'
                ],
                [
                    'password.required' => 'ban chua nhap password',
                    'password.min' =>' password phai lon hon 3 ky tu',
                    'password.max' =>' password phai nho hon 20 ky tu',
                    'passwordAgain.required'=> 'ban chua nhap lai password',
                    'passwordAgain.same'=> 'Mat khau nhap lai phai trung'
                ]
            );
            $user->password = bcrypt($request->password);
        }

        $user->save();
        Auth::logout();
        return redirect('login')->with('thongbao','Sua thanh cong');
    }
    public function getDangKy(){
        if (Auth::check()){
            return view('pages.dangky');
        }
        else{
            return  redirect('login');
        }
    }
    public function PostDangKy(Request $request){
        $this->validate($request,
            [
                'name'=> 'required|min:3|max:30',
                'password'=> 'required|min:8|max:20',
                'email'=> 'required|min:8|max:25|unique:users,email',
                'passwordAgain' =>'required|same:password'
            ],
            [
                'name.required' => 'ban chua nhap ten',
                'name.min' =>' name phai lon hon 3 ky tu',
                'name.max' =>' name phai nho hon 30 ky tu',
                'password.required' => 'ban chua nhap password',
                'password.min' =>' password phai lon hon 3 ky tu',
                'password.max' =>' password phai nho hon 20 ky tu',
                'email.required' => 'ban chua nhap ten',
                'email.min' =>' email phai lon hon 3 ky tu',
                'email.max' =>' email phai nho hon 20 ky tu',
                'email.unique' =>' email phai duy nhat',
                'passwordAgain.required'=> 'ban chua nhap lai password',
                'passwordAgain.same'=> 'Mat khau nhap lai phai trung'
            ]
        );
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->quyen = 0;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('login')->with('thongbao','them thanh cong');
    }
    public function TimKiem(Request $request){
            $tukhoa = $request->tukhoa;
            $tintuc = TinTuc::where('TieuDe','like',"%$tukhoa%")->orwhere('TomTat','like',"%$tukhoa%")
                ->orwhere('NoiDung','like',"%$tukhoa%")->take(30)->paginate(5);
            return view('pages.timkiem',['tintuc'=>$tintuc,'tukhoa'=>$tukhoa]);
    }
public  function  getGioiThieu(){
        return view('pages.gioithieu');
}
}
