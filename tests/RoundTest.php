<?php
use PHPUnit\Framework\TestCase;
use App\Round;
use App\AutomaticGame;
use App\Card;
use App\Player;


final class RoundTest extends TestCase
{
    
  

   public function test_play_an_automatic_round(){
      $game = new AutomaticGame();
      $game->setupGame(4);

      $round = new Round();

      $cardsPlayed = $round->playRound($game);
     // $this->findLastRound()->setActiveCards($gcardsPlayed);

      $this->assertEquals($game->findLastRound(), $round);
      $this->assertEquals(4, count($round->getActiveCards()));
      $this->assertEquals(4, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

      $secondRoundPlayedCards = $round->playRound($game);
      $this->assertEquals($round->getActiveCards(), $secondRoundPlayedCards);
      $this->assertEquals(8, count($game->getHistoryCards()));
      $this->assertEquals(2, $game->getTurnCount());

      $game = new AutomaticGame();
      $game->setupGame(5);

      $round = new Round();

      $cardsPlayed = $round->playRound($game);

      $this->assertEquals($game->findLastRound(), $round);
      $this->assertEquals(5, count($round->getActiveCards()));
      $this->assertEquals(5, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

   }
   
   public function test_play_round(){
      $game = new AutomaticGame();
      $game = $game->setupGame(4);

      $round = new Round();
      $round->playRound($game);

      $this->assertEquals(4, count($round->getActiveCards()));
      $this->assertEquals(4, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

      $round = new Round();
      $round->playRound($game);

      $this->assertEquals(4, count($round->getActiveCards()));
      $this->assertEquals(8, count($game->getHistoryCards()));
      $this->assertEquals(2, $game->getTurnCount());

   }
   
   public function test_find_round_winner(){

      $game = new AutomaticGame();
      $game->setupGame(4);

      $round = new Round();

      $cardsToSet = [new Card(["red","♥"], "A"), new Card(["red","♥"], "1"), new Card(["red","♥"], "2"), new Card(["red","♥"], "J")];

      $round->setActiveCards($cardsToSet);

      $winnerPlayer = $round->findRoundWinner($round->getActiveCards(), $game);
      
      $this->assertEquals($game->getPlayers()[3], $winnerPlayer);


      $game = new AutomaticGame();
      $game->setupGame(4);

      $round = new Round();


      $round = new Round();

      $cardsToSet = [new Card(["red","♥"], "10"), new Card(["red","♦"], "10"), new Card(["black", "♠"], "10"), new Card(["black","♣"], "10")];

      $round->setActiveCards($cardsToSet);

      $winnerPlayer = $round->findRoundWinner($round->getActiveCards(), $game);

      $this->assertEquals($game->getPlayers()[0], $winnerPlayer);
      

      $game = new AutomaticGame();
      $game->setupGame(4);

      $round = new Round();


      $cardsToSet = [new Card(["red","♥"], "2"), new Card(["red","♦"], "Q"), new Card(["black", "♠"], "Q"), new Card(["black","♣"], "10")];

      $round->setActiveCards($cardsToSet);

      $winnerPlayer = $round->findRoundWinner($round->getActiveCards(), $game);

      $this->assertEquals($game->getPlayers()[1], $winnerPlayer);
   
   }


   public function test_add_score_to_round_winner(){
      
      $game = new AutomaticGame();
      $game->setupGame(4);

      $round = new Round();


      $lastPlayedCards = $round->playRound($game); //it uses the private method addScoreToRoundWinner.
      $roundWinner = $round->findRoundWinner($lastPlayedCards, $game);

      $this->assertEquals(1, $roundWinner->getScore());
      
   }
   
   
   
    

}
