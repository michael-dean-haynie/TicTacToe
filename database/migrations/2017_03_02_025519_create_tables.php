<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement("
      CREATE TABLE user(
        id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        created TIMESTAMP DEFAULT NOW(), 
        updated TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255),
        -- user_type either 'simple' or 'authed'
        user_type VARCHAR(255) NOT NULL DEFAULT 'simple'
      )
    ;");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement("DROP TABLE user;");
  }
}
