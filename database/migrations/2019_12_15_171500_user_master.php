<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_master', function (Blueprint $table) {
            # 主キー
            $table->primary('id');
            
            # カラム
            $table->string('id',8)
                    ->unique()
                    ->comment('ユーザID');
            $table->string('name',50)
                    ->comment('ユーザ名');
            $table->string('email',255)
                    ->comment('メールアドレス');
            $table->string('authtext',255)
                    ->comment('認証文字列');
            $table->dateTime('create_datetime')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('作成日時');
            $table->dateTime('update_datetime')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('更新日時');
            $table->boolean('deleted')
                    ->default(false)
                    ->comment('論理削除');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_master');
    }
}
