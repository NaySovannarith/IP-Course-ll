<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->timestamp('payment_date')->useCurrent();
            $table->string('payment_method', 100);
            $table->decimal('amount', 10, 2);
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->Delete('cascade');

        });
    }

    public function down()
    {
        Schema::dropIfExists('payments');
    }
};