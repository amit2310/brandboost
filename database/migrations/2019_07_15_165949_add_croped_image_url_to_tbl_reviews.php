<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCropedImageUrlToTblReviews extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbl_reviews', function (Blueprint $table) {
            $table->text('croped_image_url')->nullable()->after('media_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbl_reviews', function (Blueprint $table) {
            $table->dropColumn('croped_image_url');
        });
    }
}
