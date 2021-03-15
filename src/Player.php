<?php
namespace App;

abstract class Player{
    protected $cards;
    protected $turnCount;
    protected $numberOfCards;
    protected $history;
    protected $score;

    function __construct(Array $cards=[], int $turnCount=0, int $numberOfCards=0, Array $history=[], String $name="Anonim", int $score=0) {

    
      $this->cards = $cards;
      $this->turnCount = $turnCount;
      $this->numberOfCards = $numberOfCards;
      $this->history = $history;
      $this->name = $name;
      $this->score = $score;
      }

      public function getCards(){
        return $this->cards;
      }

      public function addCardToPlayer(Card $card){
        array_push($this->cards, $card);
        return $this->cards;
      }

      public function getHistory(){
        return $this->history;
      }
      public function getScore(){
        return $this->score;
      }
      public function setScore(int $score){
        $this->score = $score;
        return $this->score;
      }

    abstract public function play();

    public function playCard(int $cardIndex){

      $selectedCard = $this->cards[$cardIndex];

      array_push($this->history, $selectedCard);
      array_splice($this->cards, $cardIndex, 1);
      $this->turnCount++;
      print("{$this->name} (score:{$this->score}) played : {$selectedCard->getValue()} {$selectedCard->getSymbol()->getShape()}, turn: {$this->turnCount}"."\n");
      return $selectedCard;
    }

    protected function checkIndexRange(int $cardIndex){
        return count($this->cards) > $cardIndex and $cardIndex >= 0;
    }

}

