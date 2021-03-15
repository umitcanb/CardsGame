<?php
namespace App;

final class ManualGame extends Game{

  public function createPlayers(int $numberOfPlayers){

      $numberOfPlayers = readline('How many players will play including yourself? :');

      $nameOfPlayer = strval(readline("What's your name?:"));

      $manualPlayer = new ManualPlayer( [], 0, 0, [], $nameOfPlayer);
      array_push($this->players, $manualPlayer);

      $playerNames = $this->generatePlayerNames($numberOfPlayers);

      for ($count = 0; $count < $numberOfPlayers-1; $count++){
        array_push($this->players, new AutomaticPlayer( [], 0, 0, [], $playerNames[$count]));
      }

      return $this;
  }

  /*
  public function playGame(){

      $numberOfPlayers = readline('How many players will play including yourself? :');

      $nameOfPlayer = strval(readline("What's your name?:"));
      
      $this->startManualGame($numberOfPlayers, $nameOfPlayer);

      while (count($this->historyCards) < 52){
        $this->playManualRound();
      }

      $this->findGameWinner();
      return $this;

  }

  public function playManualRound(){

    $this->players[0]->showCards(); 

    return $this->playRound();
 
  }

  protected function startManualGame(int $numberOfPlayers, String $playerName) {
    
    new ManualPlayer( [], 0, 0, [], $playerName);

    $playerNames = $this->generatePlayerNames($numberOfPlayers);

    for ($count =0; $count < $numberOfPlayers-1; $count++){
      array_push($this->players, new AutomaticPlayer( [], 0, 0, [], $playerNames[$count]));
    }

    
    $deck = new Deck();
    $deck->distributeCards($this->players);

    return $this;
  */

    

      
}