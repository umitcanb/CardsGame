<?php
namespace App;
use App\Symbol;

final class Card{
    public $symbol;
    public $value;

    function __construct(Array $symbol, String $value) {

      $this->symbol = new Symbol($symbol[0], $symbol[1]);
      $this->value = $value;
    
    }

  
}



