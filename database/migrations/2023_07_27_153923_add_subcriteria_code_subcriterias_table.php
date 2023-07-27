<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSubcriteriaCodeSubcriteriasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_criterias', function (Blueprint $table) {
            $table->string('subcriteria_code')->after('criteria_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sub_criterias', function (Blueprint $table) {
            $table->dropColumn('subcriteria_code');
        });
    }
}
