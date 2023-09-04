<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('keys', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->index()->unique();
            $table->longText('value');
            $table->jsonb('data')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keys');
    }
};
