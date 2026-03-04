<?php
namespace App\Enums;

enum ApplicationStatus:string
{
  case New   = 'new';
  case Pending   = 'in progress';
  case Cancelled = 'cancelled';
  case Completed = 'completed';
}