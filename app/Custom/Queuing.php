<?php
namespace App\Custom;

class Queuing{
  public static function queueUserForQuickMatch($id = null) {
    if (!isset($id)){
      $id = \CustomAuth::getUser()->id;
    }

    // Check if user is already queued
    $result = \DB::select("SELECT id FROM quickmatch_queue where user_id = :id", ['id' => $id]);
    if (count($result) > 0){
      return; // Do nothing. User is already queued
    }

    // Queue user.
    \DB::statement("INSERT INTO quickmatch_queue (user_id) VALUES (:id);", ['id' => $id]);
  }

  public static function un_queueUserForQuickMatch($id = null) {
    if (!isset($id)){
      $id = \CustomAuth::getUser()->id;
    }

    // Unqueue user.
    \DB::statement("DELETE FROM quickmatch_queue WHERE user_id = :id", ['id' => $id]);
  }

  public static function checkForQuickmatch(){
    // Check that there's more than 1 person queued
    $result = \DB::select("SELECT user_id FROM quickmatch_queue ORDER BY id ASC LIMIT 2;");
    if (count($result) == 2){
      $p1 = $result[0]->user_id;
      $p2 = $result[1]->user_id;

      // Create the match
      \Queuing::createMatch($p1, $p2);

      // Remove players from queue
      \Queuing::un_queueUserForQuickMatch($p1);
      \Queuing::un_queueUserForQuickMatch($p2);
    }
  }

  public static function createMatch($p1, $p2){
    \DB::statement("
      INSERT INTO `match` (player1, player2) VALUES (:p1, :p2)
    ;", ['p1' => $p1, 'p2' => $p2]);
  }

  public static function checkUserIsInMatch(){
    $id = \CustomAuth::getUser()->id;
    $result = \DB::select("
      SELECT * FROM `match`
      WHERE active = 1 AND (player1 = :id1 OR player2 = :id2)
    ;", ['id1' => $id, 'id2' => $id]);

    return count($result) > 0 ? true : false;
  }
}

?>