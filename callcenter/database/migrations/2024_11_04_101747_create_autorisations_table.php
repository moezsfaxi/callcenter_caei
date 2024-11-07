<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('autorisations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('agent_id');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('hours')->nullable();
            $table->enum('etat', ['accepté', 'refusé','en attente'])->nullable();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('autorisations');
    }
};
