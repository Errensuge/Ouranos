<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

use App\Jobs\CreateIllustrationJob;

class Contacts extends Controller
{
  public function get(Request $request) {
    return $request->method();
    // return Contact::all();
  }

  public function add(Request $request) {
    $c = Contact::create($request->all());
    if( $c->isValid() )
      if( $c->save() && $request->has('illustration') )
        dispatch(new CreateIllustrationJob($request->illustration, storage_path('app/img/'.app()->make('auth')->user()->email.'/contact/'.$id.'.jpg')));
    return 'BBBBB';
  }

  public function update(Request $request, $id) {
    $c = Contact::find($id);
    $c->fill($request);
    if( $c->isValid() )
      if( $c->save() && $request->has('illustration') )
        dispatch(new CreateIllustrationJob($request->illustration, storage_path('app/img/'.app()->make('auth')->user()->email.'/contact/'.$id.'.jpg')));
  }

  public function delete($id) { Contact::destroy($id); }
}
