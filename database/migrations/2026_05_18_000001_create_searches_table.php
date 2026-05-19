<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->string('origin', 3);
            $table->string('destination', 3);
            $table->date('date');
            $table->date('return_date')->nullable();
            $table->tinyInteger('adults')->default(1);
            $table->string('trip_type', 10)->default('oneway');
            $table->string('ip', 45)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('searches');
    }
};
