<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
  public function reviews(): void
  {
    $this->belongsTo('App\Review');
  }
}
