<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('books',function (Blueprint $table){
            $table->string('type')->default('book')->enum('book','audiobook');
            $table->string('narrator')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('books',function (Blueprint $table){
            $table->dropColumn('type');
            $table->dropColumn('narrator');
        });
    }
};
