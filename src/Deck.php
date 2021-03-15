<?php
namespace App;
use App\Card;

final class Deck{
    private $cards;
    

    function __construct() {

      $this->cards = self::createDeck();
      
    }

    public function getCards(){
      return $this->cards;
    }
  
    private static function createDeck() {
      $cards =[];
      //this is called suits
      //instead of the array, an array of symbol objects
      $symbols = [["red","♥"],["red","♦"],["black","♣"],["black","♠"]];
      $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];

      foreach ($symbols as &$symbol){
        foreach ($values as &$value){
          $card = new Card($symbol, $value);
          array_push($cards, $card);
        }
      }
      return $cards;
    }

    public function shuffle(){

      shuffle($this->cards);
      return $this;

    }
    
    public function distributeCards(Array $players){

      $this->shuffle();

      for ($x = 0; $x < count($this->cards); $x++){

        $players[$x % count($players)]->addCardToPlayer($this->cards[$x]);
        
      }

      return $players;
      
    }

  
}



