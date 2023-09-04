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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('profile_image')->nullable();
            $table->string('resume')->nullable();
            $table->string('gender')->nullable();
            $table->date('dob')->nullable();
            $table->longText('permanent_address')->nullable();
            $table->longText('current_address')->nullable();
            $table->bigInteger('contact_mobile');
            $table->string('emp_code')->nullable();
            $table->string('qualification')->nullable();
            $table->string('designation')->nullable();
            $table->string('reporting_manager')->default('1');
            $table->string('ctc')->nullable();
            $table->string('personal_linkedin')->nullable();
            $table->string('personal_skype')->nullable();
            $table->string('personal_slack')->nullable();
            $table->string('personal_github')->nullable();
            $table->string('official_linkedin')->nullable();
            $table->string('official_skype')->nullable();
            $table->string('official_slack')->nullable();
            $table->string('official_github')->nullable();
            $table->string('official_email')->nullable();
            $table->date('joining_date')->nullable();
            $table->date('leaving_date')->nullable();
            $table->date('fandf_date')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('contact_one_name')->nullable();
            $table->bigInteger('contact_one_mobile')->nullable();
            $table->string('contact_one_relationship')->nullable();
            $table->string('contact_two_name')->nullable();
            $table->bigInteger('contact_two_mobile')->nullable();
            $table->string('contact_two_relationship')->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->string('time_zone')->default('Asia/Kolkata');
            $table->string('time_offset')->default('+05:30');
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
        Schema::dropIfExists('users');
    }
};
