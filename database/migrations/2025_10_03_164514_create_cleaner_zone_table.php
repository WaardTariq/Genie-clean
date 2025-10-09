<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cleaner_zone', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cleaner_id')->constrained('cleaners')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('zone_id')->constrained('zones')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cleaner_zone');
    }
};
