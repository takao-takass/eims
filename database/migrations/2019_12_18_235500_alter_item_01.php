<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterItem01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item', function (Blueprint $table) {
            $table->string('owner',8)
                    ->comment('レコード所有者');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item', function (Blueprint $table) {
                $table->dropColumn('owner');
            });
    }
}
