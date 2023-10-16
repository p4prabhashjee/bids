<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->boolean('Is_It_Bid_Increment')->default(0)->after('reserved_price');
            $table->decimal('Bid_Increment', 10, 2)->nullable()->after('Is_It_Bid_Increment');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['Is_It_Bid_Increment', 'Bid_Increment']);
        });
    }
};
