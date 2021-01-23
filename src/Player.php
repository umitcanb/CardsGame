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
      print("{$this->name} played : {$selectedCard->value} {$selectedCard->symbol->shape}, turn: {$this->turnCount}"."\n");
      return $selectedCard;
    }

    public function showCards(){
      $count = 1;
      print("Your deck: "."\n");
      foreach ($this->cards as &$card){
        print("{$card->symbol->shape} {$card->value}, n#{$count}"."\n");
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

