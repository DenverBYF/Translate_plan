<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTranslatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translates', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('p_id');
			$table->integer('status')->default(0);
			$table->integer('u_id')->index();
			$table->longText('content');
			$table->integer('a_u_id')->index();
            $table->timestamps();
			$table->index(['p_id', 'status', 'u_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('translates');
    }
}
