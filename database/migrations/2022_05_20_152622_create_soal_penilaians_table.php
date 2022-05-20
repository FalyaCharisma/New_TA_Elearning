<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoalPenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soal_penilaians', function (Blueprint $table) {
            $table->id();
            $table->text('pertanyaan');
            $table->string('pilihan_A')->nullable();
            $table->string('pilihan_B')->nullable();
            $table->string('pilihan_C')->nullable();
            $table->string('pilihan_D')->nullable();
            $table->string('pilihan_E')->nullable();
            $table->integer('poin1');
            $table->integer('poin2');
            $table->integer('poin3'); 
            $table->integer('poin4');
            $table->integer('poin5');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('soal_penilaians');
    }
}
