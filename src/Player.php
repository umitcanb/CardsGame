<?php
namespace App;

final class Player{
    public $cards;
    public $turnCount;
    public $numberOfCards;
    public $history;

    function __construct(Array $cards=[], $turnCount=0, $numberOfCards=0, Array $history=[]) {

      $this->cards = $cards;
      $this->turnCount = $turnCount;
      $this->numberOfCards = $numberOfCards;
      $this->history = $history;
      }
   

    public function takeTurns($playersList){

    }
}

