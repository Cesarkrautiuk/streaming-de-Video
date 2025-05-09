<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('videpos', function (Blueprint $table) {
            Schema::table('videos', function (Blueprint $table) {
                $table->string('capa')->nullable()->after('video');
            });
        });
    }

    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropColumn('capa');
        });
    }
};
