<?php

namespace App\View\Components;

use App\Models\Licence;
use Illuminate\View\Component;

class DrivingLicenceCard extends Component
{
    public $licence;
    public $hideOperationsButton;
    public function __construct(Licence $licence, bool $hideOperationsButton = true) {
      $this->licence = $licence;
      $this->hideOperationsButton = $hideOperationsButton;
    }

    public function render()
    {
      return view('components.driving-licence-card');
    }
}