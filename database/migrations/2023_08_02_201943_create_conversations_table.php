<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('conversations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->text('user_input');
            $table->text('final_output');
            $table->jsonb('final_json')->nullable();
//            $table->json('assessment_steps')->nullable();
            $table->boolean('is_complete')->default(true);
            $table->smallInteger('learning_priority')->default(1); //100 is max, 0 means don't learn
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conversations');
    }
};
