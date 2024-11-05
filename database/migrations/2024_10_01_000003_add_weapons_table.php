<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        $this->down();
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->text('description');
            $table->unsignedMediumInteger('cost');
            $table->unsignedTinyInteger('damage');

            $table->unsignedBigInteger('characteristic_id')->nullable();
            $table->foreign('characteristic_id')->references('id')->on('characteristics')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down() {
        Schema::dropIfExists('weapons');
    }
};
