<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('author');
            $table->string('customPath')->nullable();
            $table->string('postTitle');
            $table->longText('postContent');
            $table->string('postCategory')->nullable();
            $table->string('featureImage')->nullable();
            $table->string('seoTitle')->nullable();
            $table->string('seoKeyword')->nullable();
            $table->string('socialImage')->nullable();
            $table->mediumText('seoDescription')->nullable();
            $table->boolean('isPublish')->default(true);
            $table->datetime('scheduleUp')->nullable();
            $table->datetime('scheduleDown')->nullable();
            $table->mediumInteger('sortKey')->nullable();
            $table->timestamps();

            /**
             * Relation foreign
             */
            $table->foreign('author')->references('id')->on('admins');
            $table->foreign('postCategory')->references('id')->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
