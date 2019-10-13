<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNhatKyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nhatky', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('nk_MaDanhMuc');
            $table->text('nk_NoiDung');
            $table->string('nk_ChucNang');
            $table->bigInteger('nk_ThoiGian');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('nhat_ky');
    }
}
