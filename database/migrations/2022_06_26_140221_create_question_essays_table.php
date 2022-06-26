<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionEssaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_essays', function (Blueprint $table) {
            $table->id();
            $table->foreignId('subject_id');
            $table->text('detail');
            $table->string('video_id')->nullable();
            $table->string('audio_id')->nullable();
            $table->string('image_id')->nullable();
            $table->string('document_id')->nullable();
            $table->text('answer');
            $table->text('explanation')->nullable();
            $table->string('created_by');
            $table->timestamps();

            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_essays');
    }
}
