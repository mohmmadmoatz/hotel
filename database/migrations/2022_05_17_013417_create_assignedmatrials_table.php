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
        Schema::create('assignedmatrials', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('matrial_id')->nullable();
            $table->bigInteger('teacher_id')->nullable();
            $table->bigInteger('stage_id')->nullable();
            $table->string('year', 255)->nullable();
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
        Schema::dropIfExists('assignedmatrials');
    }
};
