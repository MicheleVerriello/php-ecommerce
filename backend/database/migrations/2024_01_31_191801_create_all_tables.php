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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->float('price');
            $table->binary('photo')->nullable();
        });

        Schema::create('cartitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkIdUser');
            $table->foreign('fkIdUser')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('fkIdItem');
            $table->foreign('fkIdItem')->references('id')->on('items')->cascadeOnDelete();
            $table->unsignedInteger('quantity');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkIdUser');
            $table->foreign('fkIdUser')->references('id')->on('users')->cascadeOnDelete();
            $table->float('totalPrice');
            $table->timestamp('creationDate');
        });

        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkIdOrder');
            $table->foreign('fkIdOrder')->references('id')->on('orders')->cascadeOnDelete();
            $table->unsignedBigInteger('fkIdItem');
            $table->foreign('fkIdItem')->references('id')->on('items')->noActionOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('items');
        Schema::dropIfExists('cartitems');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('orderitems');
    }
};
