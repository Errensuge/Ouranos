<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
  protected $fillable = ['content', 'chain_id'];

  protected $rules = [ 'content' => ['required','string'], 'chain_id' => ['required', 'exists:chains,id'] ];

  protected function isValid()
  {
    $values = $this->getAttributes();
    $v = \Validator::make($values, $this->rules);
    return !$v->fails();
  }
}
