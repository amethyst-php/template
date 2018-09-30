<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create(Config::get('amethyst.template.managers.template.table'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('filename');
            $table->string('filetype');
            $table->text('description')->nullable();
            $table->longtext('content')->nullable();
            $table->string('checksum', 40);
            $table->integer('data_builder_id')->unsigned()->nullable();
            $table->foreign('data_builder_id')->references('id')->on(Config::get('amethyst.data-builder.managers.data-builder.table'));
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists(Config::get('amethyst.template.managers.template.table'));
    }
}
