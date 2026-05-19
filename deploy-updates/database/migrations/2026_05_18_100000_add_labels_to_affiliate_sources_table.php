<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('affiliate_sources', function (Blueprint $table) {
            $table->string('label_ar')->nullable()->after('name');
            $table->string('label_en')->nullable()->after('label_ar');
        });
    }

    public function down(): void
    {
        Schema::table('affiliate_sources', function (Blueprint $table) {
            $table->dropColumn(['label_ar', 'label_en']);
        });
    }
};
