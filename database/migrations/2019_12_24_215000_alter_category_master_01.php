<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterCategoryMaster01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('category_master', function (Blueprint $table) {
            $table->integer('inspect_cycle_month')
                    ->comment('点検周期');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('category_master', function (Blueprint $table) {
                $table->dropColumn('inspect_cycle_month');
            });
    }
}
