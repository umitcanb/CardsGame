<?php
namespace App;

final class Player{
    public $cards;
    public $turnCount;
    public $numberOfCards;
    public $history;

    function __construct(Array $cards=[], int $turnCount=0, int $numberOfCards=0, Array $history=[], String $name="Anonim") {

    
      $this->cards = $cards;
      $this->turnCount = $turnCount;
      $this->numberOfCards = $numberOfCards;
      $this->history = $history;
      $this->name = $name;
      }
   

    public function play(){

      $randomCardIndex = array_rand($this->cards, 1);
      $randomCard = $this->cards[$randomCardIndex];
      array_push($this->history, $randomCard);
      array_splice($this->cards, $randomCardIndex, 1);
      $this->turnCount++;
      print("{$this->name} played : {$randomCard->value} {$randomCard->symbol->shape}, turn: {$this->turnCount}"."\n");
      return $randomCard;

    }
}

