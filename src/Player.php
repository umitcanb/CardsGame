<?php
namespace App;

final class Player{
    public $cards;
    public $turnCount;
    public $numberOfCards;
    public $history;

    function __construct(Array $cards=[], int $turnCount=0, int $numberOfCards=0, Array $history=[]) {

      $this->cards = $cards;
      $this->turnCount = $turnCount;
      $this->numberOfCards = $numberOfCards;
      $this->history = $history;
      }
   

    public function play(){

      $randomCardIndex = array_rand($this->cards, 1);
      $randomCard = $this->cards[$randomCardIndex];
      array_push($this->history, $randomCard);
      array_splice($this->cards, $randomCardIndex, 1);
      return $randomCard;

    }
}

