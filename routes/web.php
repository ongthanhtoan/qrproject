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
Route::group(['middleware' => ['CheckLogin']], function () {
	Route::get('/admin','HomeController@index')->name('home'); 
	/*Loại*/
	Route::resource('/admin/loai','LoaiController');
	/*Đơn Vị*/
	Route::resource('/admin/don-vi','DonViController');
	/*Hiện Trạng*/
	Route::resource('/admin/hien-trang','HienTrangController');
	/*Phòng*/
	Route::resource('/admin/phong','PhongController');
	/*Tài Sản*/
	Route::resource('/admin/tai-san','TaiSanController');
	/*Reset*/
	Route::get('/admin/reset','TaiSanController@getReset')->name('reset.getReset');
	Route::post('/admin/reset/xu-ly','TaiSanController@postReset')->name('reset.postReset');
        
        //Xóa nhiều
        Route::delete('admin/tai-san-delete-multiple','TaiSanController@deleteMultiple')->name('tai-san.multiple-delete');

	/*Nhập xuất excel*/
	Route::get('admin/import','TaiSanController@getImport')->name('import.getImport');
	Route::post('admin/import/xu-ly','TaiSanController@postImport')->name('import.postImport');

	Route::get('admin/export','TaiSanController@getExport')->name('export.getExport');
	//đếm số hiện có:
	Route::get('/admin/Count-Tai-San','HomeController@CountTaiSan')->name('Count-Tai-San');
	Route::get('/admin/Count-Loai','HomeController@CountLoai')->name('Count-Loai');
	Route::get('/admin/Count-Don-Vi','HomeController@CountDonVi')->name('Count-Don-Vi');
	Route::get('/admin/Count-Hien-Trang','HomeController@CountHienTrang')->name('Count-Hien-Trang');
	Route::get('/admin/Count-Phong','HomeController@CountPhong')->name('Count-Phong');
	Route::get('/admin/Count-User','HomeController@CountUser')->name('Count-User');
	Route::get('/admin/Count-Can-Bo','HomeController@CountCanBo')->name('Count-Can-Bo');
	Route::get('/admin/Count-Ban-Giao','HomeController@CountBanGiao')->name('Count-Ban-Giao');
	Route::resource('admin/ban-giao','BanGiaoController');
	//users
	Route::get('admin/users','UsersController@index')->name('users.index');
	Route::post('admin/users-store','UsersController@store')->name('users.store');
	Route::get('admin/users-edit/{id}','UsersController@edit')->name('users.edit');
	Route::put('admin/users-update/{id}','UsersController@update')->name('users.update');
	Route::DELETE('admin/users-destroy/{id}','UsersController@destroy')->name('users.destroy');
	//cán bộ
	Route::get('admin/can-bo','CanBoController@index')->name('can-bo.index');
	Route::get('admin/can-bo/them','CanBoController@create')->name('can-bo.create');
	Route::post('admin/can-bo/them','CanBoController@store')->name('can-bo.store');
	Route::get('admin/can-bo/cap-quyen/{id}','CanBoController@capQuyen')->name('cap-quyen.capQuyen');
	Route::DELETE('admin/can-bo/xoa/{id}','CanBoController@destroy')->name('can-bo.destroy');
	Route::get('admin/can-bo/huy-quyen/{id}','CanBoController@huyQuyen')->name('cap-quyen.huyQuyen');

	// Tải file mẫu thêm tài sản
	Route::get('/admin/tai-file-mau', function(){
		$file= public_path(). "/download/themtaisantufile.xlsx";
		return response()->download($file);
	})->name('tai-file-mau');
});
/********************************************************************************************/
/*Kiểm Kê Tài Sản*/
Route::group(['middleware' => ['CheckKiemKe']], function () {
	Route::get('admin/kiem-ke-tai-san/{id}','KiemKeController@show')->name('kiem-ke-tai-san.show');
	Route::get('admin/tai-san/kiem-ke/{id}','TaiSanController@kiemKe')->name('kiem-ke.kiemKe');
	Route::get('admin/tai-san/huy-kiem-ke/{id}','TaiSanController@huyKiemKe')->name('kiem-ke.huyKiemKe');
});
/********************************************************************************************/
/*Đăng Nhập, Đăng Xuất*/
Route::get('admin/dang-nhap', 'DangNhapController@getDangNhap')->name('dang-nhap.getDangNhap');
Route::post('admin/dang-nhap/xu-ly', 'DangNhapController@postDangNhap')->name('dang-nhap.postDangNhap');
/*Đăng Nhập admin*/
Route::post('admin/dang-nhap/xu-ly/admin', 'DangNhapController@postDangNhapAdmin')->name('dang-nhap.postDangNhapAdmin');
Route::get('admin/dang-xuat',function(){
	Session::flush();
	Artisan::call('cache:clear');
	return redirect()->route('dang-nhap.getDangNhap');
})->name('dang-xuat');
/********************************************************************************************/
/*Hiển Thị Tài Sản Được Bàn Giao Cho Ai*/
Route::group(['middleware' => ['CheckCanBo']], function () {
	Route::get('admin/tai-san-duoc-ban-giao','HomeController@dsBanGiao')->name('dsBanGiao.dsBanGiao');
});