<?php
namespace App;
use App\Deck;

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

    function __construct(Array $players, int $turn_count, Array $active_cards, Array $history_cards) {

      $this->players = $players;
      $this->turn_count = $turn_count;
      $this->active_cards = $active_cards;
      $this->history_cards = $history_cards;
    
    }

    function start_game() {

      $deck = new Deck();

    
    }
    function get_Name() {
      return $this->Name;
      }
    function get_Score() {
      return $this->Score;
    }

    public function takeTurns($playersList){
      //sırayı bir sonrakine ver

  }
}

