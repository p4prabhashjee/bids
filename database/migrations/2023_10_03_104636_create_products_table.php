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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('category_id');
            $table->integer('subcategory_id');
            $table->integer('auction_type_id');
            $table->date('auction_start_date');
            $table->date('auction_end_date');
            $table->time('auction_start_time');
            $table->time('auction_end_time');
            $table->decimal('reserved_price', 10, 2);
            $table->decimal('minimum_bid', 10, 2);
            $table->text('description'); 
            $table->enum('status', ['new', 'open', 'suspended', 'closed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
