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
            $table->string('custom_path')->nullable();
            $table->string('post_title');
            $table->longText('post_content');
            $table->string('post_category')->nullable();
            $table->string('feature_image')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_keyword')->nullable();
            $table->string('seo_image')->nullable();
            $table->mediumText('seo_description')->nullable();
            $table->boolean('is_publish')->default(true);
            $table->datetime('schedule_up')->nullable();
            $table->datetime('schedule_down')->nullable();
            $table->mediumInteger('sort_key')->nullable();
            $table->timestamps();

            /**
             * Relation foreign
             */
            $table->foreign('author')->references('id')->on('admins');
            $table->foreign('post_category')->references('id')->on('categories');
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
