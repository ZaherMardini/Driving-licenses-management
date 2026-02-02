<?php

use App\Models\Driver;
use App\Models\LicenceClass;
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
      Schema::create('licences', function (Blueprint $table) {
        $table->id();
        $table->foreignIdFor(LicenceClass::class);
        $table->foreignIdFor(Driver::class);
        $table->date('issue_date');
        $table->date('expiry_date');
        $table->string('notes');
        $table->string('status')->default('new');
        $table->timestamps();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('licences');
    }
};
