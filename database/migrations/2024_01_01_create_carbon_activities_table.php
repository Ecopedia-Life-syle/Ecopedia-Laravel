<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('carbon_activities', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('type'); // transport, food, energy
            $table->string('name');
            $table->decimal('emission', 8, 2);
            $table->json('details')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('carbon_activities');
    }
};