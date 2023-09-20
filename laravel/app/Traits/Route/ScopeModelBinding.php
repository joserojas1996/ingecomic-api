<?php

namespace App\Traits\Route;

/**
 * Trait ScopeModelBinding
 */
trait ScopeModelBinding
{
  /**
   * Retrieve the model for a bound value.
   *
   * @param  mixed  $value
   * @param  string|null  $field
   * @return \Illuminate\Database\Eloquent\Model|null
   */
  public function resolveRouteBinding($value, $field = null)
  {
    if (empty($value)) {
      return $value;
    }
    return $this->where($field ?: 'id', !$field ? decrypt($value) : $value)->firstOrFail();
  }
}
