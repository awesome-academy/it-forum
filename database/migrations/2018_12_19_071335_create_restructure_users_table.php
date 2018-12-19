<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRestructureUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('name', 'username')->unique();
            $table->string('fullname')->after('password');
            $table->string('image_path')->after('fullname');
            $table->string('phone', 16)->after('image_path')->nullable();
            $table->date('birthday')->after('phone')->nullable();
            $table->tinyInteger('gender')->after('birthday');
            $table->string('address')->after('gender')->nullable();
            $table->tinyInteger('status')->after('address')->default(0);
            $table->integer('role_id')->after('status')->unsigned()->default(0);
            $table->foreign('role_id')->references('id')->on('roles');
            $table->softDeletes()->after('role_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->renameColumn('username', 'name');
            $table->dropColumn('fullname');
            $table->dropColumn('image_path');
            $table->dropColumn('phone');
            $table->dropColumn('birthday');
            $table->dropColumn('gender');
            $table->dropColumn('address');
            $table->dropColumn('status');
            $table->dropColumn('role_id');
            $table->dropColumn('deleted_at');
        });
    }
}
