<?php

namespace App\Enums;

enum  LicenceActions: string{
  case detain   = 'detain';
  case release  = 'release';
  case renew    = 'renew';
}