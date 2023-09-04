<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('functions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('module_id')->index();
            $table->string('title');
            $table->text('capability');
            $table->text('mandatory_params')->nullable();
            $table->text('default_params')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('functions');
    }
};
