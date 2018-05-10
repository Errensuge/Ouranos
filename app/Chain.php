<?php

namespace App;

use App\ModelParent;

class Chain extends ModelParent
{
    protected $fillable = ['title', 'contact_id'];
    protected $rules = [
      'title' => ['required','string'],
      'contact_id' => ['required','exists:contacts,id']
    ];
}
