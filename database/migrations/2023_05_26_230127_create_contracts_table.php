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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->integer('termination_fine');
            $table->integer('salary');
            $table->integer('duration');
            $table->string('state');
            $table->string('type');
            $table->string('function');
            $table->foreignId('club_id')
                ->constrained()
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
                $table->foreignId('professional_id')
                ->constrained()
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
