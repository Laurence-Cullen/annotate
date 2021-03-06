<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detections', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('detectable_object_id');
            $table->foreign('detectable_object_id')->references('id')->on('detectable_objects')->onDelete('cascade');
            $table->unsignedInteger('uploaded_image_id');
            $table->foreign('uploaded_image_id')->references('id')->on('uploaded_images')->onDelete('cascade');
            $table->float('confidence');
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
        Schema::dropIfExists('detections');
    }
}
