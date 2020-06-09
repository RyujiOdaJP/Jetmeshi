<?php

declare(strict_types=1);

namespace App\View\Components;

use Illuminate\View\Component;

class btn_delete extends Component
{
  /**
   * Create a new component instance.
   */
  public function __construct()
  {
  }

  /**
   * Get the view / contents that represent the component.
   *
   * @return \Illuminate\View\View|string
   */
  public function render()
  {
    return view('components.btn_delete');
  }
}
