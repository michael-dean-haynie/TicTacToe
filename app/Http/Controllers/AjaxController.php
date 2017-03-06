<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AjaxController extends Controller
{
	private $defaultResponse = ['response' => 'This is the default response.'];

  public function getDoSomething(Request $req){
    $username = \CustomAuth::getUser()->username;
    $responseJson = ['response' => "Your username is $username"];
    return json_encode($responseJson);
  }

  // Queuing =================================================
  public function readyUpQuickmatch(){
  	\Queuing::queueUserForQuickMatch();
  	return json_encode($this->defaultResponse);
  }

  public function un_readyUpQuickmatch(){
  	\Queuing::un_queueUserForQuickMatch();
  	return json_encode($this->defaultResponse);
  }

  public function checkForQuickmatch(){
  	\Queuing::checkForQuickMatch();
  	$matchFound = \Queuing::checkUserIsInMatch();
  	return json_encode(['matchFound' => $matchFound]);
  }
}
