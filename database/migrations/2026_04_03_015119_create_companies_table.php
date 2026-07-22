<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->foreignId('city_id')->nullable()->constrained('cities')->onDelete('set null');
            $table->text('address')->nullable();
            $table->timestamps();
            $table->softDeletes(); // adds deleted_at column

            // Indexes for better performance
            $table->index('city_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
