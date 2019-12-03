<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CategoryMaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_master', function (Blueprint $table) {
            # 主キー
            $table->primary('category_id');

            # カラム
            $table->string('category_id',2)
            ->comment('カテゴリID');
            $table->string('category_name',200)
            ->comment('カテゴリ名称');
            $table->string('icon_file_path')
            ->comment('アイコンファイルパス');
            $table->dateTime('create_datetime')
            ->comment('作成日時');
            $table->dateTime('update_datetime')
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
        Schema::dropIfExists('category_master');
    }
}
