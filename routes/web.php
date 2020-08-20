<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('admin.theloai.danhsach');
});

Route::get('admin/login', 'UserController@getdangnhapAdmin');
Route::post('admin/login', 'UserController@postdangnhapAdmin');
Route::get('admin/logout', 'UserController@getLogout');
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {
    Route::group(['prefix' => 'theloai'], function () {
        Route::get('danhsach', 'TheLoaiController@getDanhSach');
        Route::get('sua/{id}', 'TheLoaiController@getSua');
        Route::post('sua/{id}', 'TheLoaiController@postSua');
        Route::get('xoa/{id}', 'TheLoaiController@postXoa');
        Route::get('them', 'TheLoaiController@getThem');
        Route::post('them', 'TheLoaiController@PostThem')->name('them');
    });
    Route::group(['prefix' => 'loaitin'], function () {
        Route::get('danhsach', 'LoaiTinController@getDanhSach');
        Route::get('sua/{id}', 'LoaiTinController@getSua');
        Route::post('sua/{id}', 'LoaiTinController@postSua');
        Route::get('xoa/{id}', 'LoaiTinController@postXoa');
        Route::get('them', 'LoaiTinController@getThem');
        Route::post('them', 'LoaiTinController@PostThem')->name('them');
    });
    Route::group(['prefix' => 'tintuc'], function () {
        Route::get('danhsach', 'TinTucController@getDanhSach');
        Route::get('sua/{id}', 'TinTucController@getSua');
        Route::post('sua/{id}', 'TinTucController@postSua');
        Route::get('them', 'TinTucController@getThem');
        Route::post('them', 'TinTucController@postThem');
        Route::get('xoa/{id}', 'TinTucController@postXoa');
    });

    Route::group(['prefix' => 'slide'], function () {
        Route::get('danhsach', 'SlideController@getDanhSach');
        Route::get('sua/{id}', 'SlideController@getSua');
        Route::post('sua/{id}', 'SlideController@postSua');
        Route::get('them', 'SlideController@getThem');
        Route::post('them', 'SlideController@postThem');
        Route::get('xoa/{id}', 'SlideController@postXoa');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('danhsach', 'UserController@getDanhSach');
        Route::get('sua/{id}', 'UserController@getSua');
        Route::post('sua/{id}', 'UserController@postSua');
        Route::get('them', 'UserController@getThem');
        Route::post('them', 'UserController@postThem');
        Route::get('xoa/{id}', 'UserController@postXoa');
    });

    Route::group(['prefix' => 'comment'], function () {
        Route::get('xoa/{id}/{idTinTuc}', 'CommentController@postXoa');
    });
});
Route::group(['prefix' => 'ajax'], function () {
    Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
});

Route::get('trangchu', 'PageController@TrangChu');
Route::get('lienhe', 'PageController@LienHe');
Route::get('loaitin/{id}/{TenKhongDau}.html', 'PageController@LoaiTin');
Route::get('tintuc/{id}/{TieuDeKhongDau}.html', 'PageController@TinTuc');
Route::get('login', 'PageController@getDangNhap');
Route::post('login', 'PageController@postDangNhap');
Route::get('dangxuat', 'PageController@getDangXuat');
Route::post('comment/{id}','CommentController@postComment');
Route::get('nguoidung','PageController@getNguoiDung');
Route::post('nguoidung', 'PageController@postNguoiDung');
Route::get('dangky','PageController@getDangKy');
Route::get('gioithieu','PageController@getGioiThieu');
Route::post('dangky', 'PageController@PostDangKy');
Route::post('timkiem', 'PageController@TimKiem');
