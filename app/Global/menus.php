<?php
namespace App\Global;

class Menus{
  public static $people = [
    'title' => 'people',
    'items' => [
      'New person'       => 'person.create',
      'Show Person info' => 'person.show',
      'Edit Person info' => 'person.edit',
    ]
  ];
}