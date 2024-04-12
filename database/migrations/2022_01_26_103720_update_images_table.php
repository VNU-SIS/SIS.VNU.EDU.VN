<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->integer('gallery_id')->default(0)->change();
            $table->integer('type')->default(0)->comment('0: gallery, 1: slider, 2: banner top, 3: banner bot');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function (Blueprint $table) {
            $table->integer('gallery_id')->nullable(false)->default(null)->change();
            $table->dropColumn('type');
        });
    }
}
