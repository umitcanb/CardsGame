<?php
namespace App;

final class AutomaticGame extends Game{

  public function createPlayers(int $numberOfPlayers){

    $playerNames = $this->generatePlayerNames($numberOfPlayers);

    for ($count = 0; $count < $numberOfPlayers; $count++){
      array_push($this->players, new AutomaticPlayer( [], 0, 0, [], $playerNames[$count]));
    }

    return $this;
  }



  /*
  //proxy design pattern
      public function playGame(int $numberOfPlayers, string $nameOfPlayer){

        $this->startGame($numberOfPlayers, $nameOfPlayer);
  
        while (count($this->historyCards) < 52){
          $this->playRound();
        }
        $this->findGameWinner();
        return $this;
        
      }

     
      //round object, passing players as parameter, public method 
      //this would be "delegation" design pattern
      //I would have historical rounds, each of which is an object
  */
}