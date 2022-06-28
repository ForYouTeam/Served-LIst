<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTagTable extends Migration
{
    public function up()
    {
        Schema::create('detail_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_task')->constrained('task');
            $table->foreignId('id_tag')->constrained('tag');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('detail_tag');
    }
}
