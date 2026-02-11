<?php

namespace App\Enums;

  enum personCardMode:string {
    case read = 'read';
    case edit = 'edit';
    case new = 'new';
  };
  enum gender:string {
    case male = 'male';
    case female = 'female';
  }
