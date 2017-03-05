<?php
namespace App\Custom;

class CustomHelpers{
  public static function test(){
    return "This is a test string.";
  }

  public static function _pullOutEmails($element){
  	return $element->email;
  }

  public static function getTakenEmails(){
    $v = \DB::select("SELECT email FROM user WHERE user_type = 'authed';");
    $v = array_map('Help::_pullOutEmails', $v);
    $v = implode(',', $v);

    return $v;
  }
}

?>