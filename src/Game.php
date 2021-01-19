<?php
namespace App;
use App\Deck;
use App\Player;

/*
In `game.py` create:

A class called `Board` that contains:

- An attribute `players` that is a list of `Player`. It will contain all the players that are playing.
- An attribute `turn_count` that is an int.
- An attribute `active_cards` that will contain the last card played by each player.
- An attribute `history_cards` that will contain all the cards played since the start of the game, with the exception of `active_cards`.
- A method `start_game()` that will:
  - Start the game,
  - Fill a `Deck`,
  - Distribute the cards of the `Deck` to the players.
  - Make each `Player` `play()` a `Card` , where each player should only play 1 card per turn, and all players have to play at each turn until they have no cards left.
  - At the end of each turn, print:
    - The turn count.
    - The list of active cards.
    - The number of cards in the `history_cards`.
*/

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

    public function startGame(int $numberOfPlayers, String $playerName) {

      $playerNames = $this->generatePlayerNames($numberOfPlayers);

      for ($count=0; $count < $numberOfPlayers; $count++){
        array_push($this->players, new Player( [], 0, 0, [], $playerNames[$count]));
      }
      $this->players[0]->name = $playerName;

      
      $deck = new Deck();
      $deck->distributeCards($this->players);

      return $this;
    }

    public function playRound(){

      $this->active_cards = [];
      foreach ($this->players as &$player){
          $playedCard = $player->play();
          array_push($this->history_cards, $playedCard);
          array_push($this->active_cards, $playedCard);
      }
      $this->turn_count++;
      return $this->active_cards;

    }

    public function playAutomaticGame(int $numberOfPlayers, string $nameOfPlayer){

      $this->startGame($numberOfPlayers, $nameOfPlayer);

      while (count($this->history_cards) < 52){
        $this->playRound();
      }

      print ("Game ended");
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

