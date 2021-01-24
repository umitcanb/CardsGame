<?php
namespace App;
use App\Symbol;

final class Card{
    private $symbol;
    private $value;

    function __construct(Array $symbol, String $value) {

      $this->symbol = new Symbol($symbol[0], $symbol[1]);
      $this->value = $value;
    
    }

    public function getSymbol(){
      return $this->symbol;
    }

    public function getValue(){
      return $this->value;
    }

  
}



