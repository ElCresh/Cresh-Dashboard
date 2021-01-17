<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUpsReadingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ups_readings', function (Blueprint $table) {
            $table->id();
            $table->integer('winpower_id');
            $table->string('device_id');
            $table->string('status');
            $table->double('voltage_in');
            $table->double('frequency_in');
            $table->double('voltage_out');
            $table->double('frequency_out');
            $table->double('current_load_percentage');
            $table->integer('battery_capacity_percentage');
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
        Schema::dropIfExists('ups_readings');
    }
}
