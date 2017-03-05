<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
  public function getCreate(){
    return view('auth/auth');
  }

  public function postCreate(Request $req){
    if(!$req->has('user-type') || !in_array($req->input('user-type'), ['simple', 'authed'])){
      throw new \Exception('Field Error: "user-type" was either invalid or non-present.');
    }

    $userType = $req->input('user-type');
    $takenEmails = \Help::getTakenEmails();
    
    $valRules = [];
    if ($userType == 'simple'){
      $valRules = [
        'simple-username' => 'required|max:255',
      ];
    } else if ($userType == 'authed'){
      $valRules = [
        'authed-username'         => 'required|max:255',
        'authed-email'            => 'required|max:255|not_in:'.$takenEmails,
        'authed-password'         => 'required|max:255|min:6',
        'authed-confirm-password' => 'required|max:255|min:6|same:authed-password',
      ];
    }

    $valMsgs = [
      'not_in' => 'Sorry, that email is already taken!',
      'same'   => 'Your password and confirmation did not match, please try again.',
    ];

    $this->validate($req, $valRules, $valMsgs);

    $newId = \CustomAuth::create($req);
    \CustomAuth::login($newId);
    return redirect('start');
  }

  public function getLogin(Request $req){
    return view('auth/login');
  }

  public function postLogin(Request $req){
    $valRules = [
      'email' => 'required',
      'password' => 'required',
    ];

    $this->validate($req, $valRules);

    // Check email/password
    $e = $req->input('email');
    $p = $req->input('password');

    $matches = false;
    $result = \DB::select("SELECT id, password FROM user WHERE email = :e", ['e' => $e]);
    if (count($result) > 0){
      if (\Hash::check($p, $result[0]->password)){
        $matches = true;
        $id = $result[0]->id;
      }
    }

    if (!$matches){
      return redirect()->back()->withErrors(['msg' => 'The password did not match the specified email address.']);
    }

    \CustomAuth::login($id);
    return redirect('start');
  }


  public function getLogout(Request $req){
    \CustomAuth::logout();
    return redirect('auth/login');
  }
}
