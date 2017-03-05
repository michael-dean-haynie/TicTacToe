<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PopulateTables extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    DB::statement("
      INSERT INTO user (username, email, password, user_type) 
      VALUES ('hullowurld', 'hullo@wurld.lol', :pwd, 'authed')
    ;", ["pwd" => Hash::make('hullowurld')]);

    DB::statement("
      INSERT INTO user (username, email, password, user_type) 
      VALUES ('Utallon', NULL, NULL, 'simple')
    ;");
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    DB::statement("DELETE FROM user;");
  }
}
