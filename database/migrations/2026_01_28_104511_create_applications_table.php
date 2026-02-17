<?php

use App\Enums\ApplicationStatus;
use App\Models\ApplicationType;
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
      Schema::create('applications', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(ApplicationType::class)->nullable(false);
        $table->foreignIdFor(User::class, 'created_by_user')->nullable(false);
        $table->foreignIdFor(Person::class)->nullable(false);
        $table->decimal('fees',5,2);
        $table->string('status')->default(ApplicationStatus::New->value);
        $table->timestamps();
      });
    }

    public function down(): void
    {
      Schema::dropIfExists('applications');
    }
};
