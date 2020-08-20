<?php

namespace App\Http\Controllers;

use App\TheLoai;
use App\User;
use Illuminate\Http\Request;
use App\Slide;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function getDanhSach(){
        $user = User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    public function getThem(){
        $user = User::all();
        return view('admin.user.them',['user'=>$user]);
    }

    public function PostThem(Request  $request){
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
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/them')->with('thongbao','them thanh cong');
    }
    public function getSua($id){
        $user = User::find($id);
        return view('admin.user.sua',['user'=>$user]);

    }
    public function postSua(Request  $request,$id){
        $user = User::find($id);
        $this->validate($request,
            [
                'name'=> 'required|min:3|max:30',
                'password'=> 'required|min:8|max:20',
                'email'=> 'required|min:8|max:25',
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
                'passwordAgain.required'=> 'ban chua nhap lai password',
                'passwordAgain.same'=> 'Mat khau nhap lai phai trung'
            ]
        );
        $user->name = $request->name;
        $user->email = $request->email;
        $user->quyen = $request->quyen;
        $user->password = bcrypt($request->password);
        $user->save();
        return redirect('admin/user/danhsach')->with('thongbao','Sua thanh cong');
    }

    public function postXoa($id){
        $user = User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach/')->with('thongbao','xoa thanh cong');
    }

    public function getdangnhapAdmin(){
        return view('admin.login');
    }
    public function postdangnhapAdmin(Request $request){
        $this->validate($request,
        [
            'email'=>'required',
            'password'=>'required|min:3|max:32',
        ],[
            'email.required'=>'ban chua nhap email',
                'password.required'=>'ban chua nhap password',
                'password.min'=>'password min la 3',
                'password.max'=>'password max la 32'
            ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            return redirect('admin/theloai/danhsach');
        }
        else{
            return redirect('admin/login')->with('thongbao','dang nhap khong thanh cong');
        }
    }
    public function getLogout(){
        Auth::logout();
        return redirect('admin/login');
    }
}
