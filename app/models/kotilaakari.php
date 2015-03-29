<?php

class Kotilaakari extends BaseModel{
  // Attribuutit
  public $id, $player_id, $name, $played, $description, $published, $publisher, $added;
  // Konstruktori
  public function __construct($attributes){
    parent::__construct($attributes);
  }
}