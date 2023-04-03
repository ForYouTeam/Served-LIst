<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{

    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_regist');
            $table->foreignId('id_user')->nullable()->constrained('users');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('staff');
    }
}
