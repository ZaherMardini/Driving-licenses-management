<?php

namespace App\Enums;

  enum CardMode:string {
    case read = 'read';
    case edit = 'edit';
    case new = 'new';
  };