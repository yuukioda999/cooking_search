<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedbigInteger('user_id')->comment('ユーザID');
            $table->string('name');
            $table->string('profile_image')->nullable()->comment('料理画像');
            $table->string('text1',1000)->comment('材料');
            $table->string('text2',1000)->comment('レシピ');
            $table->softDeletes();
            $table->timestamps();

            $table->index('id');
            $table->index('user_id');
            

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('recipes');
    }
}
