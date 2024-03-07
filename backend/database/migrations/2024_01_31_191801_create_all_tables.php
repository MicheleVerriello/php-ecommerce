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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
        });

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->float('price');
            $table->longText('photo')->nullable();
            $table->float('quantity');
            $table->boolean('isoffer');
            $table->unsignedBigInteger('fkidcategory');
            $table->foreign('fkidcategory')->references('id')->on('categories')
                ->onDelete('cascade');
        });

        Schema::create('cartitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkiduser');
            $table->foreign('fkiduser')->references('id')->on('users')->cascadeOnDelete();
            $table->unsignedBigInteger('fkiditem');
            $table->foreign('fkiditem')->references('id')->on('items')->onDelete('cascade');
            $table->unsignedInteger('quantity');
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkiduser');
            $table->foreign('fkiduser')->references('id')->on('users')->cascadeOnDelete();
            $table->float('totalPrice');
            $table->timestamp('creationDate');
        });

        Schema::create('orderitems', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fkidorder');
            $table->foreign('fkidorder')->references('id')->on('orders')->cascadeOnDelete();
            $table->unsignedBigInteger('fkiditem');
            $table->foreign('fkiditem')->references('id')->on('items')->noActionOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cartitems');
        Schema::dropIfExists('orderitems');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('items');
        Schema::dropIfExists('categories');
    }
};
