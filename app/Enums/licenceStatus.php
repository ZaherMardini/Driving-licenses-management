<?php

namespace App\Enums;

enum LicenceStatus: string
{
  case new = 'new';
  case renew = 'renew';
  case rep_missing = 'replacement_for_missing';
  case rep_damaged = 'replacement_for_damaged';
}