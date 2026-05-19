<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('popular_routes', function (Blueprint $table) {
            $table->id();
            $table->string('origin', 3);
            $table->string('destination', 3);
            $table->string('label_ar');
            $table->string('label_en');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('popular_routes');
    }
};
