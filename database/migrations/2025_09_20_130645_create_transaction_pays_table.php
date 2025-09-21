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
        Schema::create('transaction_pays', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 15,2);
            $table->foreignId('created_by')->contrained('users', 'id');
            $table->foreignId('transaction_id')->constrained('transactions', 'id');
            $table->date('date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_pays');
    }
};
