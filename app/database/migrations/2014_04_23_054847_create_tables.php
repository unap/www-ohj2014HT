<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    // Create images table
    Schema::create('images', function(Blueprint $table)
    {
      //Attributes
      $table->increments('id');
      $table->string('path');
      $table->string('title');
      $table->text('description')->nullable(); // Description is optional
      $table->integer('points')->default(0);
      $table->integer('user_id')->unsigned();
      $table->timestamps();
      // FK
      $table->foreign('user_id')->references('id')->on('users');
    });

    // Create comments table
    Schema::create('comments', function(Blueprint $table)
    {
      //Attributes
      $table->integer('image_id')->unsigned();
      $table->integer('user_id')->unsigned();
      $table->text('body');
      $table->integer('points')->default(0);
      $table->timestamps();
      //Keys
      $table->foreign('image_id')->references('id')->on('images');
      $table->foreign('user_id')->references('id')->on('users');
      $table->primary(array('created_at', 'user_id'));
    });

    // Add fields to Sentry's users table
    Schema::table('users', function(Blueprint $table)
    {
      $table->string('location');
      $table->text('description')->nullable(); // Description is optional
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::drop('images');
    Schema::drop('comments');
  }

}
