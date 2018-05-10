<?php

namespace App;

use App\ModelParent;

class Document extends ModelParent
{
    protected $fillable = ['title', 'description'];

    protected $rules = [
      'title' => ['required','string'],
      'description' => ['string'],
      'file' => ['required','file']
    ];
}
