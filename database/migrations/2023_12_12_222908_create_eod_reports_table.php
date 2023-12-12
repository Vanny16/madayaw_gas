<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEodReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eod_reports', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id', 255);
            $table->integer('prd_id');
            $table->integer('quantity');
            $table->timestamps();
            $table->integer('pdn_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eod_reports');
    }
}
