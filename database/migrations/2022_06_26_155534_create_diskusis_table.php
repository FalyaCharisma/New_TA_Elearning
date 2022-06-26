<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiskusisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diskusis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id');
            $table->string('pertanyaan');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('materi_id')->references('id')->on('materi')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    } 

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diskusis');
    }
}
