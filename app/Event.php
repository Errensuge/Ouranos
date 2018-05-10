<?php

namespace App;

use App\ModelParent;

class Event extends ModelParent
{
    protected $fillable = ['title', 'description', 'start', 'end', 'contact_id'];

    protected $rules = [
      'title' => ['required','string'],
      'description' => ['string'],
      'start' => ['required','date','date_format:Y-m-d','before:end'],
      'end' => ['required','date','date_format:Y-m-d','after:start'],
      'contact_id' => ['required','exists:contacts,id']
    ];
}
