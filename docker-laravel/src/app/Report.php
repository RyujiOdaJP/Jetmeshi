<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  /**
   * Define an inverse one-to-one or many relationship.
   *
   * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::belongsTo
   */
  public function review()
  {
    return $this->belongsTo('App\Review');
  }
}
