<?php 
namespace App\Enums;

enum ApplicationTypes :int{
  case newlicence = 1;
  case renewlicence = 2;
  case lost = 3;
  case damaged = 4;
}