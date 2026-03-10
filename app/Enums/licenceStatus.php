<?php

namespace App\Enums;

enum LicenceStatus: string
{
  case new = 'Active';
  case detained = 'Detained';
  case expired = 'Expired';
}