<?php

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
        Schema::create('bus', function (Blueprint $table) {
            $table->integerIncrements('id');
            $table->integer('unitnumber');
            $table->string('licenseplate');
            $table->string('model');
            $table->integer('capacity');
            $table->date('year');
            $table->foreignId('id_carrier')->constrained('carriers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_bus');
    }
};
