<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class Events extends Controller
{
  public function get(Request $request) { return Event::all(); }

  public function add(Request $request) {
    $e = Event::create($request->all());
    if( $e->isValid() ) $e->save();
  }

  public function update(Request $request, $id) {
    $e = Event::find($id);
    $e->fill($request);
    if( $e->isValid() ) $e->save();
  }

  public function delete($id) { Event::destroy($id); }
}
