<?php

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
    return redirect()->route('home');
});
Route::group(['prefix' => 'quan-ly', 'middleware' => ['CheckLogin']], function () {
    // Nhật ký
    Route::get('nhat-ky','NhatKyController@index')->name('nhat-ky.index');
    Route::POST('nhat-ky-search','NhatKyController@index_search')->name('nhat-ky.index_search');
    Route::get('/', 'HomeController@index')->name('home');
    /* Loại */
    Route::resource('loai', 'LoaiController');
    /* Đơn Vị */
    Route::resource('don-vi', 'DonViController');
    /* Hiện Trạng */
    Route::resource('hien-trang', 'HienTrangController');
    /* Phòng */
    Route::resource('phong', 'PhongController');
    /* Tài Sản */
    Route::resource('tai-san', 'TaiSanController');
    /* Reset */
    Route::get('khoi-tao-du-lieu', 'TaiSanController@getReset')->name('reset.getReset');
    Route::post('khoi-tao-du-lieu/xu-ly', 'TaiSanController@postReset')->name('reset.postReset');

    //Xóa nhiều
    Route::delete('tai-san-delete-multiple', 'TaiSanController@deleteMultiple')->name('tai-san.multiple-delete');
    Route::delete('ban-giao-delete-multiple', 'BanGiaoController@deleteMultiple')->name('ban-giao.multiple-delete');
    /* Nhập xuất excel */
    Route::get('import', 'TaiSanController@getImport')->name('import.getImport');
    Route::post('import/xu-ly', 'TaiSanController@postImport')->name('import.postImport');

    Route::get('export', 'TaiSanController@getExport')->name('export.getExport');
    //đếm số hiện có:
    Route::get('Count-Tai-San', 'HomeController@CountTaiSan')->name('Count-Tai-San');
    Route::get('Count-Loai', 'HomeController@CountLoai')->name('Count-Loai');
    Route::get('Count-Don-Vi', 'HomeController@CountDonVi')->name('Count-Don-Vi');
    Route::get('Count-Hien-Trang', 'HomeController@CountHienTrang')->name('Count-Hien-Trang');
    Route::get('Count-Phong', 'HomeController@CountPhong')->name('Count-Phong');
    Route::get('Count-User', 'HomeController@CountUser')->name('Count-User');
    Route::get('Count-Can-Bo', 'HomeController@CountCanBo')->name('Count-Can-Bo');
    Route::get('Count-Ban-Giao', 'HomeController@CountBanGiao')->name('Count-Ban-Giao');
    Route::resource('ban-giao', 'BanGiaoController');
    //users
    Route::get('users', 'UsersController@index')->name('users.index');
    Route::post('users-store', 'UsersController@store')->name('users.store');
    Route::get('users-edit/{id}', 'UsersController@edit')->name('users.edit');
    Route::put('users-update/{id}', 'UsersController@update')->name('users.update');
    Route::DELETE('users-destroy/{id}', 'UsersController@destroy')->name('users.destroy');
    //cán bộ
    Route::get('can-bo', 'CanBoController@index')->name('can-bo.index');
    Route::get('can-bo/them', 'CanBoController@create')->name('can-bo.create');
    Route::post('can-bo/them', 'CanBoController@store')->name('can-bo.store');
    Route::get('can-bo/cap-quyen/{id}', 'CanBoController@capQuyen')->name('cap-quyen.capQuyen');
    Route::DELETE('can-bo/xoa/{id}', 'CanBoController@destroy')->name('can-bo.destroy');
    Route::get('can-bo/huy-quyen/{id}', 'CanBoController@huyQuyen')->name('cap-quyen.huyQuyen');

    // Tải file mẫu thêm tài sản
    Route::get('tai-file-mau', function() {
        $file = public_path() . "/download/themtaisantufile.xlsx";
        return response()->download($file);
    })->name('tai-file-mau');
});
/* * ***************************************************************************************** */
/* Kiểm Kê Tài Sản */
Route::group(['prefix' => 'quan-ly', 'middleware' => ['CheckKiemKe']], function () {
    Route::get('kiem-ke-tai-san/{id}', 'KiemKeController@show')->name('kiem-ke-tai-san.show');
    Route::get('tai-san/kiem-ke/{id}', 'TaiSanController@kiemKe')->name('kiem-ke.kiemKe');
    Route::get('tai-san/huy-kiem-ke/{id}', 'TaiSanController@huyKiemKe')->name('kiem-ke.huyKiemKe');
});
/* * ***************************************************************************************** */
/* Đăng Nhập, Đăng Xuất */
Route::get('quan-ly/dang-nhap', 'DangNhapController@getDangNhap')->name('dang-nhap.getDangNhap');
Route::post('quan-ly/dang-nhap/xu-ly', 'DangNhapController@postDangNhap')->name('dang-nhap.postDangNhap');
/* Đăng Nhập admin */
Route::post('quan-ly/dang-nhap/xu-ly/admin', 'DangNhapController@postDangNhapAdmin')->name('dang-nhap.postDangNhapAdmin');
Route::get('quan-ly/dang-xuat', function() {
    Session::flush();
    Artisan::call('cache:clear');
    return redirect()->route('dang-nhap.getDangNhap');
})->name('dang-xuat');
/* * ***************************************************************************************** */
/* Hiển Thị Tài Sản Được Bàn Giao Cho Ai */
Route::group(['prefix' => 'can-bo', 'middleware' => ['CheckCanBo']], function () {
    Route::get('tai-san-duoc-ban-giao', 'HomeController@dsBanGiao')->name('dsBanGiao.dsBanGiao');
});
