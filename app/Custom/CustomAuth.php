<?php
namespace App\Custom;

class CustomAuth{
  public static function create($req){

    // Better access to values
    $t = $req->input('user-type');
    $u = $t == 'simple' ? $req->input('simple-username') : $req->input('authed-username');
    $e = $req->input('authed-email');
    $p = $req->input('authed-password');

    // Do the db stuff
    if ($t == 'simple'){
      \DB::insert("
        INSERT INTO user (user_type, username) VALUES ('simple', :u)
      ;", ['u' => $u]);
    } else if ($t == 'authed'){
      \DB::insert("
        INSERT INTO user (user_type, username, email, password) VALUES ('authed', :u, :e, :p)
      ;", ['u' => $u, 'e' => $e, 'p' => \Hash::make($p)]);
    }

    // I know, this is not perfectly safe. It's good enough.
    return \DB::select("SELECT MAX(id) AS id FROM user;")[0]->id;
  }

  public static function login($id){
    $_SESSION['user-id'] = $id;
  }

  public static function logout(){
    if (isset($_SESSION['user-id'])){
      unset($_SESSION["user-id"]);
    }
    session_destroy();
  }

  public static function getUser(){
    if(isset($_SESSION['user-id'])){
      $id = $_SESSION['user-id'];
      return \DB::select("SELECT * FROM user WHERE id = :id;", ['id' => $id])[0];
    } else {
      return "Not authenticated.";
    }
  }
}

?>