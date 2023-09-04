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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_type_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('profile_image')->nullable();
            $table->string('email')->unique();
            $table->bigInteger('mobile');
            $table->string('linkedin')->nullable();
            $table->string('skype')->nullable();
            $table->string('slack')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_country')->nullable();
            $table->string('company_state')->nullable();
            $table->date('business_since')->nullable();
            $table->enum('is_active', ['0', '1'])->default('1');
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
        Schema::dropIfExists('clients');
    }
};
