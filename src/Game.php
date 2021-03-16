<?php
namespace App;
use App\Deck;
use App\Player;

abstract class Game{
    protected $players;
    protected $turnCount;
    protected $activeCards;
    protected $historyCards;

    function __construct(Array $players = [], int $turnCount = 0, Array $activeCards = [], Array $historyCards = []) {

      $this->players = $players;
      $this->turnCount = $turnCount;
      $this->activeCards = $activeCards;
      $this->historyCards = $historyCards;
    
    }

    public function getPlayers(){
      return $this->players;
    }

    public function getTurnCount(){
      return $this->turnCount;
    }

    public function getActiveCards(){
      return $this->activeCards;
    }

    public function setActiveCards(Array $cards){
      foreach ($cards as &$card){
        array_push($this->activeCards, $card);
      }
      return $this->activeCards;
    }

    public function getHistoryCards(){
      return $this->historyCards;
    }

    public function executeGame(int $numberOfPlayers){

      $this->setupGame($numberOfPlayers);

      while (intval(52 / $numberOfPlayers) > $this->turnCount){
        $this->playRound();
      }

      $this->findGameWinner();
      return $this;

    }

    abstract public function createPlayers(int $numberOfPlayers);

    public function setupGame(int $numberOfPlayers) {

      $this->createPlayers($numberOfPlayers);
      
      $deck = new Deck();
      $deck->distributeCards($this->players);

      return $this;
    }

    public function playRound(){

      $this->activeCards = [];
      foreach ($this->players as &$player){
          $playedCard = $player->play();
          array_push($this->historyCards, $playedCard);
          array_push($this->activeCards, $playedCard);
      }
      $this->turnCount++;
      $roundWinner = $this->findRoundWinner($this->activeCards);
      self::addScoreToRoundWinner($roundWinner);

      return $this->activeCards;

    }



    public function findRoundWinner(Array $lastPlayedCards){

      $symbols =["♥", "♦", "♣", "♠"];
      $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
      $winnerPlayerIndex = 0;
      $winnerCard = $lastPlayedCards[0];
      
      for ($count = 0 ; $count < count($this->players); $count++){
        if (array_search($lastPlayedCards[$count]->getValue(), $values) > array_search($winnerCard->getValue(), $values)){
          $winnerPlayerIndex = $count;
          $winnerCard = $lastPlayedCards[$count];
        }
        if ($lastPlayedCards[$count]->getValue() == $winnerCard->getValue()){
          if (array_search($lastPlayedCards[$count]->getSymbol()->getShape(), $symbols) < array_search($winnerCard->getSymbol()->getShape(), $symbols)){
            $winnerPlayerIndex = $count;
            $winnerCard = $lastPlayedCards[$count];
          }
        }
      }
      
      print("{$this->players[$winnerPlayerIndex]->name} has won this round with the card {$winnerCard->getValue()}, {$winnerCard->getSymbol()->getShape()}."."\n");
      return $this->players[$winnerPlayerIndex];
      
    }

    private static function addScoreToRoundWinner(Player $winnerPlayer){
        $newScore = $winnerPlayer->getScore += 1;
        $winnerPlayer->setScore($newScore);
        return $winnerPlayer->getScore();
    }

    public function findGameWinner(){
      $winner = $this->players[0];
      foreach($this->players as &$player){
        if ($player->getScore() > $winner->getScore()){
          $winner = $player;
        }
      }

      if ($this->isTie($winner)){
        print ("There is tie!");
        return Null;
      }

      print ("The winner is {$winner->name} with the score {$winner->getScore()}!");
      return $winner;
    }

    private function isTie(Player $winner){

      foreach ($this->players as &$player){
        if ($player->getScore() == $winner->getScore() && $player != $winner){
           return True; 
        }
      }
      return False;
    }


    protected function generatePlayerNames(int $numberOfPlayers){
      
      $playerNames = [];
      for ($count = 1; $count <= $numberOfPlayers; $count++){
        $playerName = "Player ".strval($count);
        array_push($playerNames, $playerName);
      }

      return $playerNames;
    }

    

    

    
}

