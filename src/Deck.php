<?php
namespace App;
use App\Card;

final class Deck{
    public $cards;
    

    function __construct() {

      $this->cards = self::createDeck();
      
    }
  
    private static function createDeck() {
      $cards =[];
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
      return $this->cards;

    }
    
    public function distributeCards(Array $players){

      $this->shuffle();

      for ($x = 0; $x < count($this->cards); $x++){

        array_push($players[$x % count($players)]->cards, $this->cards[$x]);
        
      }

      return $players;
      
    }

  
}



