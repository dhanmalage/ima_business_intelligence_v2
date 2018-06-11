<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApiSyncsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_syncs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_details')->nullable();
            $table->integer('attendees')->nullable();
            $table->integer('event_time')->nullable();
            $table->integer('event_price')->nullable();
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
        Schema::dropIfExists('api_syncs');
    }
}
