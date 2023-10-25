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
        Schema::create('tender_vendor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_id');
            $table->foreignId('vendor_id');
            $table->string('proposal_doc');
            $table->string('boq_doc');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_vendor');
    }
};
