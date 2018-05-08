<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TranslateLike extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::create('t_like', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('t_id');
			$table->integer('u_id');
			$table->integer('status');
			$table->index(['u_id', 't_id', 'status']);
		});
		Schema::create('a_like', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('a_id');
			$table->integer('u_id');
			$table->integer('status');
			$table->index(['u_id', 'a_id', 'status']);
		});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
		Schema::dropIfExists('t_like');
		Schema::dropIfExists('a_like');
    }
}
