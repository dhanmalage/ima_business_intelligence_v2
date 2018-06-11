<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_prices', function (Blueprint $table) {
            $table->integer('id');
            $table->integer('event_id')->nullable();
            $table->string('price_type')->nullable();
            $table->decimal('event_cost',20,2)->nullable()->default(0.00);
            $table->decimal('surcharge',10,2)->nullable()->default(0.00);
            $table->string('surcharge_type')->nullable();
            $table->string('member_price_type')->nullable();
            $table->decimal('member_price',20,2)->nullable()->default(0.00);
            $table->integer('max_qty')->nullable()->default(0);
            $table->integer('max_qty_members')->nullable()->default(0);
            $table->timestamps();

            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events_prices');
    }
}
