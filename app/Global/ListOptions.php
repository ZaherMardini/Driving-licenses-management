<?php
namespace App\Global;

use App\Enums\TestTypes;

class ListOptions{
  public static function localLicence(int $localLicenceId) {
  $vision = TestTypes::VisionTest->value;
  $written = TestTypes::WrittenTest->value;
  $street = TestTypes::StreetTest->value;
  return 
    [
      'vision'  => "/appointments/{$localLicenceId}/{$vision}/create",
      'written' => "/appointments/{$localLicenceId}/{$written}/create",
      'street'  => "/appointments/{$localLicenceId}/{$street}/create",
    ];
  }
}