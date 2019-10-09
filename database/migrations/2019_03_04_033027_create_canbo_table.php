<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCanboTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('canbo', function (Blueprint $table) {
            $table->string('cb_TenDangNhap');
            $table->string('cb_HoTen');
            $table->unsignedTinyInteger('cb_KiemKe');
            $table->primary('cb_TenDangNhap');
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
