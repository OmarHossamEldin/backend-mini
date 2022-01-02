<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('subcategory_id')->nullable()->constrained('categories');
            $table->double('amount', 5);
            $table->foreignId('customer_id')->constrained('users');
            $table->date('due_on');
            $table->double('vat', 5);
            $table->double('is_vat_inclusive', 5);
            $table->enum('status', ['paid', 'outstanding', 'overdue']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
