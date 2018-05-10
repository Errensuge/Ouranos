<?php

namespace App;

use App\ModelParent;

class Contact extends ModelParent
{
    protected $fillable = ['name', 'email', 'phone', 'grade', 'entreprise'];

    protected $rules = [
      'name' => ['required','string'],
      'email' => ['required','email'],
      'phone' => ['string'],
      'grade' => ['string'],
      'entreprise' => ['required','string'],
      'illustration' => ['file|mimes:jpeg,jpg,png']
    ];
}
