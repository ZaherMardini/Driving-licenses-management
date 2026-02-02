<?php
namespace App\Enums;

enum ApplicationStatus:string
{
  case Pending   = 'new';
  case Cancelled = 'cancelled';
  case Completed = 'completed';
}