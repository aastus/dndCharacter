<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(){
        Schema::create('alignments', function (Blueprint $table) {
            $table->id();
            $table->string('name', 25);
            $table->text('description');
        });
    }

    public function down() {
        Schema::dropIfExists('alignments');
    }
};