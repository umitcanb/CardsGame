<?php
namespace App;

final class Player{
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
   

    public function playRandomCard(){

      $randomCardIndex = array_rand($this->cards, 1);

      return $this->play($randomCardIndex);
      

    }

    public function play(int $cardIndex){

      if (!$this->checkIndexRange($cardIndex)){
        print("the number indicated does not correspond to any card in your hand");
        return $this->selectAndPlayCard();
      }

      $selectedCard = $this->cards[$cardIndex];

      array_push($this->history, $selectedCard);
      array_splice($this->cards, $cardIndex, 1);
      $this->turnCount++;
      print("{$this->name} (score:{$this->score}) played : {$selectedCard->getValue()} {$selectedCard->getSymbol()->getShape()}, turn: {$this->turnCount}"."\n");
      return $selectedCard;
    }

    public function showCards(){
      $count = 1;
      print("Your deck: "."\n");
      foreach ($this->cards as &$card){
        print("{$card->getSymbol()->getShape()} {$card->getValue()}, n#{$count}"."\n");
        $count++;
      }
      return $this->cards;
    }

    public function selectAndPlayCard(){
      $cardIndex = intval(readline('Enter the index number of the card you want to play')-1);

      return $this->play($cardIndex);
    }

    private function checkIndexRange(int $cardIndex){
        return count($this->cards) > $cardIndex and $cardIndex >= 0;
    }

}

