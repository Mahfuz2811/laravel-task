<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContentIdColumnInScrapingDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('scraping_data', function (Blueprint $table) {
            $table->unsignedBigInteger('content_id')->after('image_url');
            $table->softDeletes();

            $table->foreign('content_id')->references('id')->on('contents')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('scraping_data', function (Blueprint $table) {
            $table->dropColumn('content_id');
        });
    }
}
