<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Token extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('token', function (Blueprint $table) {
            # 主キー
            $table->primary('signtext');
            
            # カラム
            $table->string('signtext',255)
                    ->unique()
                    ->comment('識別文字列');
            $table->string('id',8)
                    ->comment('ユーザID');
            $table->string('ipaddress',40)
                    ->comment('クライアントIPアドレス');
            $table->dateTime('expire_datetime')
                    ->comment('失効日時');
            $table->dateTime('create_datetime')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('作成日時');
            $table->dateTime('update_datetime')
                    ->default(DB::raw('CURRENT_TIMESTAMP'))
                    ->comment('更新日時');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('token');
    }
}
