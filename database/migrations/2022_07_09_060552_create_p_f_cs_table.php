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
        Schema::create('p_f_cs', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('user_id');
            $table->string('proteins')->default(0);
            $table->string('fats')->default(0);
            $table->string('carbohydrates')->default(0);
            $table->string('KKAL')->default(0);
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
        Schema::dropIfExists('p_f_cs');
    }
};
