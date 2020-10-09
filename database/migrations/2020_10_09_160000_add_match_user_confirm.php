<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMatchUserConfirm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('matches', function (Blueprint $table) {
            $table->string('user_id_1_confirm')->default('');
			$table->string('user_id_2_confirm')->default('');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('matches', function (Blueprint $table) {
			$table->dropColumn('user_id_1_confirm');
            $table->dropColumn('user_id_2_confirm');
        });
        Schema::enableForeignKeyConstraints();
    }
}
