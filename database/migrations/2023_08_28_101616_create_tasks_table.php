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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');
            // $table->foreignId('assigned_to')->references('id')->on('users');
            // $table->foreignId('assigned_by')->references('id')->on('users');
            $table->bigInteger('assigned_to')->default('1');
            $table->bigInteger('assigned_by')->default('1');
            $table->dateTime('start_date_time');
            $table->dateTime('end_date_time');
            $table->enum('priority', ['1', '2','3'])->default('1');
            $table->enum('status', ['1', '2', '3', '4', '5', '6'])->default('1');
            $table->longText('description')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('notes')->nullable();
            $table->enum('billable', ['0', '1'])->nullable();
            $table->longText('file')->nullable();
            // $table->foreignId('created_by')->references('id')->on('users');
            $table->bigInteger('created_by')->default('1');
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
        Schema::dropIfExists('tasks');
    }
};
