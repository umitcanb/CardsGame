<?php
namespace App;
use App\Deck;
use App\Player;

final class Game{
    public $players;
    public $turn_count;
    public $active_cards;
    public $history_cards;

    function __construct(Array $players = [], int $turn_count = 0, Array $active_cards = [], Array $history_cards = []) {

      $this->players = $players;
      $this->turn_count = $turn_count;
      $this->active_cards = $active_cards;
      $this->history_cards = $history_cards;
    
    }

    public function startGame(int $numberOfPlayers, ?String $playerName) {

      $playerNames = $this->generatePlayerNames($numberOfPlayers);

      for ($count=0; $count < $numberOfPlayers; $count++){
        array_push($this->players, new Player( [], 0, 0, [], $playerNames[$count]));
      }
      $this->players[0]->name = $playerName;

      
      $deck = new Deck();
      $deck->distributeCards($this->players);

      return $this;
    }

    public function playAutomaticRound(){

      $this->active_cards = [];
      foreach ($this->players as &$player){
          $playedCard = $player->playRandomCard();
          array_push($this->history_cards, $playedCard);
          array_push($this->active_cards, $playedCard);
      }
      $this->turn_count++;
      return $this->active_cards;

    }

    public function playAutomaticGame(int $numberOfPlayers, string $nameOfPlayer){

      $this->startGame($numberOfPlayers, $nameOfPlayer);

      while (count($this->history_cards) < 52){
        $this->playAutomaticRound();
        $roundWinner = $this->findRoundWinner();
        $roundWinner->score++;
      }
      print ("Game ended");
      return $this;
      
    }

    public function playRound(){

      $this->active_cards = [];

      $this->players[0]->showCards(); 

      $playedCard = $this->players[0]->selectAndPlayCard();

      array_push($this->history_cards, $playedCard);
      array_push($this->active_cards, $playedCard);

      for ($count = 1; $count <count($this->players); $count++){
          $playedCard = $this->players[$count]->playRandomCard();
          array_push($this->history_cards, $playedCard);
          array_push($this->active_cards, $playedCard);
      }
      $this->turn_count++;
      
      return $this->active_cards;
    }

    public function findRoundWinner(){

      $symbols =["♥", "♦", "♣", "♠"];
      $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
      $winnerPlayerIndex = 0;
      $winnerCard = $this->active_cards[0];
      
      for ($count = 0 ; $count < count($this->players); $count++){
        if (array_search($this->active_cards[$count]->value, $values) > array_search($winnerCard->value, $values)){
          $winnerPlayerIndex = $count;
          $winnerCard = $this->active_cards[$count];
        }
        if ($this->active_cards[$count]->value == $winnerCard->value){
          if (array_search($this->active_cards[$count]->symbol->shape, $symbols) < array_search($winnerCard->symbol->shape, $symbols)){
            $winnerPlayerIndex = $count;
            $winnerCard = $this->active_cards[$count];
          }
        }
      }
      
      print("{$this->players[$winnerPlayerIndex]->name} has won this round with the card {$winnerCard->value}, {$winnerCard->symbol->shape}."."\n"."Active Cards: {$this->active_cards[0]->value}");
      return $this->players[$winnerPlayerIndex];
      
    }

    public function playConsoleGame(){

      $numberOfPlayers = readline('How many players will play including yourself? :');

      $nameOfPlayer = strval(readline("What's your name?:"));
      
      $this->startGame($numberOfPlayers, $nameOfPlayer);

      while (count($this->history_cards) < 52){
        $this->playRound();
        $roundWinner = $this->findRoundWinner();
        $roundWinner->score++;
      }
      print ("Game ended"."\n");
      return $this;

    }


    private function generatePlayerNames(int $numberOfPlayers){
      
      $playerNames = [];
      for ($count = 1; $count <= $numberOfPlayers; $count++){
        $playerName = "Player ".strval($count);
        array_push($playerNames, $playerName);
      }

      return $playerNames;
    }

    

    

    
}

