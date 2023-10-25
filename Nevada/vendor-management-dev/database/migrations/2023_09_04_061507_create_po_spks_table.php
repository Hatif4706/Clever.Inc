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
        Schema::create('po_spks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id');
            $table->foreignId('vendor_id');
            $table->string('pospk_doc');
            // $table->enum('pospk_doc_status', ['Available', 'Not Available']);
            $table->enum('approval', ['Approved', 'Rejected'])->nullable();
            $table->string('approval_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('po_spk');
    }
};
