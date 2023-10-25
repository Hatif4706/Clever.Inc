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
        Schema::create('tenders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->timestamps();
            $table->date('date_start');
            $table->date('date_end');
            $table->text('description');
            $table->string('tor_doc');
            $table->string('support_doc');
            $table->enum('status', ['Open', 'Closed'])->default('Open');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenders');
    }
};
