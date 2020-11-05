<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDataProfile extends Migration
{
    /**
     * Run the migrations.
     *s
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::table('users', function (Blueprint $table) {
            $table->string('firstname')->default('')->nullable(true);
            $table->string('lastname')->default('')->nullable(true);
            $table->string('telephone')->default('')->nullable(true);
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
        Schema::table('users', function (Blueprint $table) {
			$table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('telephone');
        });
        Schema::enableForeignKeyConstraints();
    }
}
