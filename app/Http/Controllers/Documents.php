<?php

namespace App\Http\Controllers;

use App\Document;
use Illuminate\Http\Request;

use App\Jobs\CreateFromPDFJob;

class Documents extends Controller
{
  public function get(Request $request) { return Document::all(); }

  public function add(Request $request) {
    $d = Document::create($request->all());
    if( $d->isValid() && $d->save() ) dispatch(new CreateFromPDFJob($request->file, storage_path('app/img/'.app()->make('auth')->user()->email.'/document/'.$document->id.'.jpg')));
  }

  public function update(Request $request, $id) {
    $d = Document::find($id);
    $d->fill($request);
    if( $d->isValid() ) $d->save();
  }

  public function delete($id) { Document::destroy($id); }
}
