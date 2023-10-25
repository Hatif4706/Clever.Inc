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
        Schema::create('tender_project_evaluation', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tender_id');
            $table->foreignId('tender_vendor_id');
            $table->string('technical_evaluation_doc');
            // $table->string('selected_vendor');
            $table->enum('approval', ['Approved', 'Rejected'])->nullable();
            $table->string('reason')->nullable();
            $table->enum('status', [
                'Need PO & SPK', 'Need Approval PO & SPK', 'Need Closing'
            ])->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tender_project_evaluation');
    }
};
