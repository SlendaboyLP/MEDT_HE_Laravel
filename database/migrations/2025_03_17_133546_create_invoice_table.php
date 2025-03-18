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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('Name');
            $table->double('PriceNet');
            $table->double('PriceGross');
            $table->double('Vat');
            $table->string('UserClearing')->nullable();
            $table->dateTime('ClearingDate')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};


