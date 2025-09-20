<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaction_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();

            $table->string('service_name');
            $table->string('service_unit');
            $table->decimal('service_price', 15, 2);
            $table->decimal('quantity', 15, 2);
            $table->decimal('total', 15, 2)->nullable()->default(0);

            $table->timestamps();
        });

        // Add trigger before insert
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_transaction_services");
        DB::unprepared("
                CREATE TRIGGER before_insert_transaction_services
                BEFORE INSERT ON transaction_services
                FOR EACH ROW
                BEGIN
                    SET NEW.total = NEW.service_price * NEW.quantity;
                END
            ");

        // Add trigger before update
        DB::unprepared("DROP TRIGGER IF EXISTS before_update_transaction_services");
        DB::unprepared("
                CREATE TRIGGER before_update_transaction_services
                BEFORE UPDATE ON transaction_services
                FOR EACH ROW
                BEGIN
                    SET NEW.total = NEW.service_price * NEW.quantity;
                END
            ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop trigger before insert
        DB::unprepared("DROP TRIGGER IF EXISTS before_insert_transaction_services");

        // Drop trigger before update
        DB::unprepared("DROP TRIGGER IF EXISTS before_update_transaction_services");

        Schema::dropIfExists('transaction_services');
    }
};
