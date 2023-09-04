<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('knowledgebases', function (Blueprint $table) {
            $table->id();
            $table->string('about')->index()->unique(); // 'preferences', 'business', 'business_model', 'module_{slug}'
            $table->text('content')->nullable();
            $table->jsonb('data');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('knowledgebases');
    }
};
