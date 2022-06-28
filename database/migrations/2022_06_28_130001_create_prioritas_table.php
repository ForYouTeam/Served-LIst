<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrioritasTable extends Migration
{

    public function up()
    {
        Schema::create('prioritas', function (Blueprint $table) {
            $table->id();
            $table->string('nama_prioritas');
            $table->integer('deadline');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prioritas');
    }
}
