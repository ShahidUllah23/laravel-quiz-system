<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();                         // id
            $table->string('name');               // category name
            $table->string('creator')->nullable(); // creator (admin name or email)
            $table->timestamps();                 // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
