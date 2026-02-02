<?php

use App\Models\ApplicationType;
use App\Models\Person;
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
      Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(Person::class)->nullable(false);
        $table->foreignIdFor(ApplicationType::class)->nullable(false);
        $table->string('status')->default('new');
        $table->decimal('fee', 2, 2);
        $table->timestamps();
      });
    }

    public function down(): void
    {
      Schema::dropIfExists('applications');
    }
};
