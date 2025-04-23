<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */ 
    public function up()
    {
        Schema::create('inventory', function (Blueprint $table) {
            $table->id();
            $table->string('item_name'); // Name of the item
            $table->decimal('unit_price', 8, 2); // Price per unit
            $table->string('supplier')->nullable(); // Supplier name
            $table->string('description')->nullable(); // description 
            $table->string('supplier')->nullable(); // Supplier name
            $table->integer('stock_before')->default(0); // restocked_quantity 
            $table->integer('restocked_quantity')->default(0); // restocked_quantity 
            $table->integer('balance')->default(0); // Quantity in stock 
            $table->string('requested_by')->nullable(); // Person who restocked the item
            $table->timestamp('applied_date')->nullable(); // Date when the item was last restocked
            $table->string('approved_by')->nullable(); // Person who restocked the item
            $table->timestamp('approved_date')->nullable(); // Date when the item was last restocked
            $table->string('status')->default('Available'); // Status of the item (Available by default)
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventory');
    }
}