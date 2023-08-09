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
        Schema::create('table_events', function (Blueprint $table) {
            $table->id();
            $table->string('event_name')->default(''); 
            $table->text('event_description')->default('');
            $table->dateTime('event_date_from')->nullable()->default(null); 
            $table->dateTime('event_date_to')->nullable()->default(null);
            $table->binary('poster')->nullable();
            $table->text('active')->nullable()->default('');
            $table->timestamps();
        });

        DB::statement('ALTER TABLE table_events MODIFY COLUMN poster LONGBLOB');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
