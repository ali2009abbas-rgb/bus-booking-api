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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('trip_number')->unique(); // رقم الرحلة مثل TR-101
            $table->string('origin');                 // نقطة الانطلاق (مثل: دمشق)
            $table->string('destination');            // الوجهة (مثل: اللاذقية)
            $table->dateTime('departure_time');      // موعد المغادرة
            $table->decimal('base_price', 10, 2);     // السعر الأساسي
            $table->integer('total_seats')->default(40); // إجمالي المقاعد
            $table->string('type')->default('standard'); // نوع الرحلة: standard أو vip
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
