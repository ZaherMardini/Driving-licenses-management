<?php

namespace App\Enums;

enum LicenceStatus: string
{
  case new = 'Active';
  case suspended = 'Suspended';
  case expired = 'Expired';
}