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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone');
            $table->datetime('date');
            $table->string('time');
            $table->foreignId('team_id')->constrained('teams')->nullable()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services')->nullable()->cascadeOnDelete();
            $table->tinyInteger('status')->default(0)->comment('0: Beklemede, 1: Onaylandı, 2: Reddedildi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
