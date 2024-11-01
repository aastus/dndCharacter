<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('proficiencies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 20);
            $table->unsignedBigInteger('characteristic_id')->nullable();
            $table->foreign('characteristic_id')->references('id')->on('characteristics')->onDelete('set null');
        });
    }

    public function down() {
        Schema::dropIfExists('proficiencies');
    }
};