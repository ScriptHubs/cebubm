<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('guests', function (Blueprint $table) {
            $table->id();
            $table->string('name_first', 255)->nullable();
            $table->string('name_last', 255)->nullable();
            $table->string('name_middle', 255)->nullable();
            $table->string('selectedMembership', 255)->nullable();
            $table->string('email_address', 255)->nullable();
            $table->string('company', 255)->nullable();
            $table->string('industry', 255)->nullable();
            $table->string('reference', 255)->nullable();
            $table->text('reference_text')->nullable();
            $table->text('connect_text')->nullable();
            $table->string('sectorBoxoption', 255)->nullable();
            $table->string('connect', 255)->nullable(); // Not sure if it's 'connect' or 'connect_text'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
