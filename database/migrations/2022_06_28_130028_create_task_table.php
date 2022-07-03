<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaskTable extends Migration
{
    public function up()
    {
        Schema::create('task', function (Blueprint $table) {
            $table->id();
            $table->string('code_task');
            $table->string('nama_task');
            $table->foreignId('level_prioritas')->constrained('prioritas');
            $table->foreignId('id_staff')->constrained('staff');
            $table->longText('deskripsi');
            $table->string('status');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('task');
    }
}
