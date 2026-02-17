<?php

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\LicenceClass;
use App\Models\Person;
use App\Models\User;
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
        Schema::create('local_licences', function (Blueprint $table) {
          $table->id();
          $table->foreignIdFor(LicenceClass::class)->nullable(false);
          $table->foreignIdFor(Application::class)->nullable(false);
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('local_licences');
    }
};
