<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id(); // primary key

            $table->string('name'); // quiz name

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
