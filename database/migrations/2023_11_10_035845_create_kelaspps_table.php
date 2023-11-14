<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kelasspps', function (Blueprint $table) {
            $table->increments('id_kelasspp');
            $table->unsignedBigInteger('id_kelas');
            $table->unsignedBigInteger('id_kompetensi')->nullable();
            $table->unsignedBigInteger('id_spp');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('siswaspps');
    }
};
