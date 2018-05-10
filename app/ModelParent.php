<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class ModelParent extends Model
{
  use SoftDeletes;

  protected $rules = [];

  protected $dates = [ 'created_at', 'updated_at', 'deleted_at' ];

  protected static function boot()
  {
    parent::boot();
    static::creating(function($m){ $m->user_id = app()->make('auth')->user()->id; });
    static::updating(function($m){ $m->user_id = app()->make('auth')->user()->id; });
    static::addGlobalScope('byUser', function (Builder $builder) { $builder->where('user_id', '=', app()->make('auth')->user()->id); });
  }

  public function isValid()
  {
    $values = $this->getAttributes();
    $v = \Validator::make($values, $this->rules);
    return !$v->fails();
  }

}
