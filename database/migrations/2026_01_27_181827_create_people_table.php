<?php

use App\Models\Country;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::create('people', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Country::class);
        $table->string('name')->nullable(false);
        $table->string('gender')->default('male');
        $table->string('national_no')->nullable(false);
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->string('image_path')->nullable();
        $table->string('address')->nullable();
        $table->date('date_of_birth');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('people');
    }
};
