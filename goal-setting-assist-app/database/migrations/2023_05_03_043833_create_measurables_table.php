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
        Schema::create('measurables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('solution_id')->constrained()->cascadeOnDelete();
            $table->text('progress_unit');
            $table->integer('progress_value');
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
        Schema::dropIfExists('measurables');
    }
};
