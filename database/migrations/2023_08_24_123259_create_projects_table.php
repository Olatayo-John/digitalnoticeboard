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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('client_id')->constrained()->onDelete('cascade');
            $table->enum('priority', ['1', '2','3'])->default('1');
            $table->enum('status', ['1', '2', '3', '4', '5', '6'])->default('1');
            $table->date('start_date');
            $table->date('due_date');
            $table->longText('objective')->nullable();
            $table->string('url')->nullable();
            $table->enum('type', ['1', '2'])->default('1');
            $table->longText('notes')->nullable();
            $table->longText('remarks')->nullable();
            $table->longText('credentials')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
