<?php
namespace App;

final class ManualPlayer extends Player{

    public function play(){

      $this->showCards();

      $cardIndex = intval(readline('Enter the index number of the card you want to play')-1);


      if (!$this->checkIndexRange($cardIndex)){
        print("the number indicated does not correspond to any card in your hand");
        return $this->play();
      }

      return $this->playCard($cardIndex);
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


}

