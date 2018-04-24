<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserInfo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
		Schema::table('users', function (Blueprint $table) {
			$table->string('desc')->nullable();
			$table->string('url')->nullable();
			$table->integer('sex')->default(0);
			$table->integer('age')->default(-1);
			$table->string('wechat')->nullable();
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
		Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('desc');
			$table->dropColumn('url');
			$table->dropColumn('sex');
			$table->dropColumn('age');
			$table->dropColumn('wechat');
		});
    }
}
