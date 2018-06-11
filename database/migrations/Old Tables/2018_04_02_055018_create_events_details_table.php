<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_details', function (Blueprint $table) {
            $table->integer('id');
            $table->string('event_code')->nullable()->default(0);
            $table->string('event_name')->nullable();
            $table->text('event_desc')->nullable();
            $table->string('display_desc')->nullable()->default('Y');
            $table->string('display_reg_form')->nullable()->default('Y');
            $table->string('event_identifier')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('registration_start')->nullable();
            $table->string('registration_end')->nullable();
            $table->string('registration_startT')->nullable();
            $table->string('registration_endT')->nullable();
            $table->string('visible_on')->nullable();
            $table->text('address')->nullable();
            $table->text('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone')->nullable();
            $table->string('venue_title')->nullable();
            $table->string('venue_url')->nullable();
            $table->text('venue_image')->nullable();
            $table->string('venue_phone')->nullable();
            $table->string('virtual_url')->nullable();
            $table->string('virtual_phone')->nullable();
            $table->string('reg_limit')->nullable()->default('999999');
            $table->string('allow_multiple')->nullable()->default('N');
            $table->integer('additional_limit')->nullable()->default(5);
            $table->string('send_mail')->nullable()->default('Y');
            $table->string('is_active')->nullable()->default('Y');
            $table->string('event_status')->nullable()->default('A');
            $table->text('conf_mail')->nullable();
            $table->string('use_coupon_code')->nullable()->default('N');
            $table->string('use_groupon_code')->nullable()->default('N');
            $table->text('category_id')->nullable();
            $table->text('coupon_id')->nullable();
            $table->float('tax_percentage',10,2)->nullable();
            $table->integer('tax_mode')->nullable();
            $table->string('member_only')->nullable();
            $table->integer('post_id')->nullable();
            $table->string('post_type')->nullable();
            $table->string('country')->nullable();
            $table->string('externalURL')->nullable();
            $table->string('early_disc')->nullable();
            $table->string('early_disc_date')->nullable();
            $table->string('early_disc_percentage')->nullable()->default('N');
            $table->longText('question_groups')->nullable();
            $table->longText('item_groups')->nullable();
            $table->string('event_type')->nullable();
            $table->string('allow_overflow')->nullable()->default('N');
            $table->integer('overflow_event_id')->nullable()->default(0);
            $table->integer('recurrence_id')->nullable()->default(0);
            $table->integer('email_id')->nullable()->default(0);
            $table->text('alt_email')->nullable();
            $table->longText('event_meta')->nullable();
            $table->integer('wp_user')->nullable()->default(1);
            $table->integer('require_pre_approval')->nullable()->default(0);
            $table->string('timezone_string')->nullable();
            $table->integer('likes')->nullable();
            $table->integer('ticket_id')->nullable()->default(0);
            $table->dateTime('submitted')->nullable();
            //$table->string('imabi_event_status')->nullable()->default('Open');
            //$table->integer('imabi_attendees_complete')->nullable()->default(0);
            //$table->integer('imabi_attendees_incomplete')->nullable()->default(0);
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
        Schema::dropIfExists('events_details');
    }
}
