<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('f_id');
			$table->integer('t_id')->index();
			$table->string('content');
			$table->string('href')->nullable();
			$table->integer('status')->default(0);
			$table->string('title')->default('新的消息通知');
            $table->timestamps();
			$table->index(['t_id', 'status']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
