<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMasterBeritasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_beritas', function (Blueprint $table) {

            $table->smallIncrements('id_berita');

            $table->text('judul')->nullable()->default('text');

            $table->text('sub_title')->nullable()->default('text');

            $table->text('deskripsi')->nullable()->default('text');

            $table->timestamps();
            // $table->dateTime('created_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_beritas');
    }
}