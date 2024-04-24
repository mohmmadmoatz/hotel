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
        Schema::create('matrials', function (Blueprint $table) {
            $table->id();
            $table->string('code', 255)->nullable();
            $table->bigInteger('stage_id')->nullable();
            $table->string('name_ar', 255)->nullable();
            $table->string('name_en', 255)->nullable();
            $table->string('unit_count', 255)->nullable();
            $table->float('quest_degree')->nullable()->default(123.45);

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
        Schema::dropIfExists('matrials');
    }
};
