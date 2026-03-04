<?php

namespace App\View\Components;

use App\Models\Licence;
use App\Models\LocalLicence;
use Illuminate\View\Component;

class DrivingLicenceCard extends Component
{
    // public $name;
    // public $licenceId;
    // public $licenceClass;
    // public $issueDate;
    // public $expiryDate;
    // public $notes;
    // public $status;
    // public $image;

    public $localLicence;
    public $licence;
    public function __construct(Licence $licence) {
      $this->licence = $licence;
      // $this->name = $localLicence['person']['name'];
      // $this->licenceId = $licence['licence_id'];
      // $this->licenceClass = $localLicence['licence_class']['title'];
      // $this->issueDate = now();
      // $this->expiryDate = now()->addyears($localLicence['licence_class']['valid_years']);
      // $this->notes = $licence['notes'];
      // $this->status = $licence['status'];
      // $this->image = $localLicence['person']['image_path'];
    }

    public function render()
    {
      return view('components.driving-licence-card');
    }
}