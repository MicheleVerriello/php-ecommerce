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

        Schema::table('items', function (Blueprint $table) {
            $table->unsignedBigInteger('fkIdCategory')->nullable();
            $table->foreign('fkIdCategory')
                ->references('id')
                ->on('categories')
                ->onDelete('set null'); // Set the foreign key to NULL when the related record is deleted
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign(['fkIdCategory']);
            $table->dropColumn('fkIdCategory');
        });

        Schema::dropIfExists('categories');
    }
};
