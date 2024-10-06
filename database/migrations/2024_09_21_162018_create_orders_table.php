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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone');
            $table->string('country_name');
            $table->string('address');
            $table->string('apartment');
            $table->string('city');
            $table->string('state');
            $table->string('zip')->nullable();
            $table->integer('sub_total');
            $table->integer('shipping_charge');
            $table->integer('coupon_discount')->default(0);
            $table->integer('total_charge');
            $table->enum('payment_status',['paid','not_paid'])->default('not_paid');
            $table->enum('status',['pending','shipped','delivered','cancelled'])->default('pending');
            $table->timestamp('shipped_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
