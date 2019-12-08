<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MaintenanceHistory extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('maintenance_history', function (Blueprint $table) {
            # 主キー
            $table->primary('history_id');
            # カラム
            $table->string('history_id',15)
                    ->comment('履歴ID');
            $table->string('id',12)
                    ->comment('アイテムID');
            $table->date('inspect_date')
                    ->comment('実施日');
            $table->string('comment')
                    ->comment('コメント');
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
        Schema::dropIfExists('maintenance_history');
    }
}
