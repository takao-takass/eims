<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Item extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            # 主キー
            $table->primary('id');
            
            # カラム
            $table->string('id',12)
                    ->unique()
                    ->comment('アイテムID');
            $table->string('name')
                    ->comment('アイテム名');
            $table->string('category_id',2)
                    ->comment('カテゴリID');
            $table->date('purchase_date')
                    ->comment('購入日');
            $table->date('limit_date')
                    ->comment('期限日');
            $table->integer('quantity')
                    ->comment('数量');
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
        Schema::dropIfExists('item');
    }
}
