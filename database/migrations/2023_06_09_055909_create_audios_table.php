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
        Schema::create('audios', function (Blueprint $table) {
            $table->id();
            $table->foreignId("room_id")->constrained()->onDelete("cascade");
            $table->string("name");
            $table->string("file");
            $table->float("initial_volume")->default(0.5);
            $table->boolean("loop")->default(false);
            $table->boolean("pausable")->default(false);
            $table->boolean("music")->default(false);
            $table->boolean("ambience")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audios');
    }
};
