<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaisanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taisan_'.date('Y'), function (Blueprint $table) {
            $table->string('ts_MaTS');
            $table->primary('ts_MaTS');
            $table->text('ts_TenTS');
            $table->integer('ts_SoLuong');
            $table->integer('ts_NguyenGia');
            $table->string('ts_Nam');
            $table->string('ts_NgayKiemKe');
            $table->text('ts_NangCap')->nullable();
            $table->unsignedTinyInteger('ts_KiemKe');
            $table->unsignedTinyInteger('l_MaLoai');
            $table->unsignedTinyInteger('ht_MaHT');
            $table->string('cb_TenDangNhap');
			$table->integer('ts_HieuLuc')->nullable();;
            $table -> foreign("l_MaLoai") -> references("l_MaLoai") -> on("loai")->onUpdate('CASCADE');
            $table -> foreign("ht_MaHT") -> references("ht_MaHT") -> on("hientrang")->onUpdate('CASCADE');
            $table -> foreign("cb_TenDangNhap") -> references("cb_TenDangNhap") -> on("canbo")->onUpdate('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
