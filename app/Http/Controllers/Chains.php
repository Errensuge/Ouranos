<?php

namespace App\Http\Controllers;

use App\Chain;
use App\Email;
use Illuminate\Http\Request;
use App\Http\Mail;

class Chains extends Controller
{
  public function get(Request $request) { return Chain::all(); }

  public function add(Request $request) {
    $c = Chain::create($request->all());
    if( $c->isValid() ) $c->save();
  }

  public function delete($id) { Chain::destroy($id); }

  public function getMessage($id) { return Email::where('chain_id', $id)->get(); }

  public function addMessage(Request $request, $id) {
    $m = Email::create(['content' => $request->content, 'chain_id' => $id]);
    if( $m->isValid() && Mail::send($m->content, $m->chain_id) ) $m->save();
  }

  public function sync(Request $request) { Mail::sync(); }
}
