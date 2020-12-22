<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToFolders extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // !!注意!! phpunitでSQLiteをDB指定しています。SQLiteの仕様上、NOT NULL制約の追加はできないためuser_idにnullableをセットしています。
        Schema::table('folders', function (Blueprint $table) {
            $table->bigInteger('user_id')->nullable()->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('folders', function (Blueprint $table) {
            //
            $table->dropForeign('folders_user_id_foreign');
        });
    }
}
