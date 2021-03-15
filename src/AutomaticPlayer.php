<?php
namespace App;

final class AutomaticPlayer extends Player{

  public function play(){

    $randomCardIndex = array_rand($this->cards, 1);

    return $this->playCard($randomCardIndex);
    
  }


}

