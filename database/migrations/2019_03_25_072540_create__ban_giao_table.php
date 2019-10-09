<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanGiaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bangiao', function (Blueprint $table) {
            $table->bigIncrements('bg_MaBG');
            $table->string('bg_NguoiGiao');
            $table->string('bg_NgayGiao');
            $table->string('bg_NguoiNhan');
            $table->string('bg_NgayNhan');
            $table->string('ts_MaTS');
            $table->unsignedTinyInteger('dv_MaDV');
            $table->unsignedTinyInteger('p_MaPhong');
            $table -> foreign("dv_MaDV") -> references("dv_MaDV") -> on("donvi")->onUpdate('CASCADE');
            $table -> foreign("p_MaPhong") -> references("p_MaPhong") -> on("phong")->onUpdate('CASCADE');
            $table->foreign('ts_MaTS')->references('ts_MaTS')->on('taisan_'.date('Y'))->onUpdate('CASCADE');
            $table->foreign('bg_NguoiGiao')->references('cb_TenDangNhap')->on('canbo')->onUpdate('CASCADE');
            $table->foreign('bg_NguoiNhan')->references('cb_TenDangNhap')->on('canbo')->onUpdate('CASCADE');
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
