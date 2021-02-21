<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSumPointsToGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->integer('sum_of_points')->after('revealed_at')->default(0);
            $table->integer('allowed_spins')->after('sum_of_points')->default(0);
            $table->foreign('campaign_id')
                ->references('id')
                ->on('campaigns')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('prizeId')
                ->references('id')
                ->on('prizes')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('games', function (Blueprint $table) {
            $table->dropForeign('games_campaign_id_foreign');
            $table->dropForeign('games_prizeId_foreign');
            $table->dropColumn('sum_of_points');
            $table->dropColumn('allowed_spins');
        });
    }
}
