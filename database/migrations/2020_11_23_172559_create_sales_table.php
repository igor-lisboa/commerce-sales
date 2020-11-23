<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('client_id')->references('id')->on('clients');
            $table->foreignId('payment_method_id')->references('id')->on('payment_methods')->nullable();
            $table->boolean('canceled')->default(false);
            $table->integer('amount_paid_cents')->nullable();
            $table->integer('change_paid_cents')->nullable();
            $table->integer('used_points')->nullable();
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
        Schema::dropIfExists('sales');
    }
}
