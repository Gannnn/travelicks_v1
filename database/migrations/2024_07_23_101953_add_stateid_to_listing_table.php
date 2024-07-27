<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStateidToListingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->unsignedBigInteger('stateId')->default(1);

            $table->foreign('stateId')->references('id')->on('states');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('listing', function (Blueprint $table) {
            $table->dropColumn('stateId');

            $table->dropForeign(['stateId']);
        });
    }
}
