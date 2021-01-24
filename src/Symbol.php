<?php
namespace App;

final class Symbol{
    private $color;
    private $shape;

    function __construct(String $color, String $shape) {
      $this->color = $color;
      $this->shape = $shape;
    }
  
    function getColor() {
      return $this->color;
    }
    
    function getShape() {
      return $this->shape;
    }

  
}



