<?php
use PHPUnit\Framework\TestCase;
use App\AutomaticGame;
use App\Card;
use App\Player;


final class AutomaticGameTest extends TestCase
{
    
   public function test_setup_game(){
      
      $game = new AutomaticGame();
      $game->setupGame(4);

      $this->assertEquals(count($game->getPlayers()), 4);
      $this->assertEquals(count($game->getPlayers()[0]->getCards()), 13);
      $this->assertNotEquals($game->getPlayers()[0]->getCards(), $game->getPlayers()[1]->getCards());
      $this->assertEquals($game->getTurnCount(), 0);

      $game2 = new AutomaticGame();
      $game2->setupGame(2);

      $this->assertEquals(count($game2->getPlayers()), 2);
      $this->assertEquals(count($game2->getPlayers()[0]->getCards()), 26);

      $game2 = new AutomaticGame();
      $game2->setupGame(5);

      $this->assertEquals(count($game2->getPlayers()), 5);
      $this->assertEquals(count($game2->getPlayers()[0]->getCards()), 11);
      $this->assertEquals(count($game2->getPlayers()[4]->getCards()), 10);


   }

   public function test_play_an_automatic_round(){
      $game = new AutomaticGame();

      $game->setupGame(4);
      $cardsPlayed = $game->playRound();
     // $this->setActiveCards($gcardsPlayed);

      $this->assertEquals($game->getActiveCards(), $game->getActiveCards());
      $this->assertEquals(4, count($game->getActiveCards()));
      $this->assertEquals(4, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

      $secondRoundPlayedCards = $game->playRound();
      $this->assertEquals($game->getActiveCards(), $secondRoundPlayedCards);
      $this->assertEquals(8, count($game->getHistoryCards()));
      $this->assertEquals(2, $game->getTurnCount());

      $game = new AutomaticGame();

      $game->setupGame(5);
      $cardsPlayed = $game->playRound();

      $this->assertEquals($game->getActiveCards(), $game->getActiveCards());
      $this->assertEquals(5, count($game->getActiveCards()));
      $this->assertEquals(5, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

   }
   
   public function test_play_automatic_game_when_players_have_equal_number_of_cards(){
      $game = new AutomaticGame();
      $game->executeGame(4);

      $this->assertEquals(4, count($game->getActiveCards()));
      $this->assertEquals(52, count($game->getHistoryCards()));
      $this->assertEquals(52 / 4, $game->getTurnCount());

   }

   public function test_execute_automatic_game_when_players_do_not_have_equal_number_of_cards(){
      $game = new AutomaticGame();
      $game->executeGame(5);

      $this->assertEquals(5, count($game->getActiveCards()));
      $this->assertEquals(50, count($game->getHistoryCards()));
      $this->assertEquals(intval(52 / 5), $game->getTurnCount());

   }

   public function test_play_round(){
      $game = new AutomaticGame();
      $game = $game->setupGame(4);

      $game->playRound();

      $this->assertEquals(4, count($game->getActiveCards()));
      $this->assertEquals(4, count($game->getHistoryCards()));
      $this->assertEquals(1, $game->getTurnCount());

      $game->playRound();

      $this->assertEquals(4, count($game->getActiveCards()));
      $this->assertEquals(8, count($game->getHistoryCards()));
      $this->assertEquals(2, $game->getTurnCount());

   }
   
   public function test_find_round_winner(){

      $game = new AutomaticGame();
      $game->setupGame(4);

      $cardsToSet = [new Card(["red","♥"], "A"), new Card(["red","♥"], "1"), new Card(["red","♥"], "2"), new Card(["red","♥"], "J")];

      $game->setActiveCards($cardsToSet);

      $winnerPlayer = $game->findRoundWinner($game->getActiveCards());
      
      $this->assertEquals($game->getPlayers()[3], $winnerPlayer);


      $game = new AutomaticGame();
      $game->setupGame(4);

      $cardsToSet = [new Card(["red","♥"], "10"), new Card(["red","♦"], "10"), new Card(["black", "♠"], "10"), new Card(["black","♣"], "10")];

      $game->setActiveCards($cardsToSet);

      $winnerPlayer = $game->findRoundWinner($game->getActiveCards());

      $this->assertEquals($game->getPlayers()[0], $winnerPlayer);
      

      $game = new AutomaticGame();
      $game->setupGame(4);

      $cardsToSet = [new Card(["red","♥"], "2"), new Card(["red","♦"], "Q"), new Card(["black", "♠"], "Q"), new Card(["black","♣"], "10")];

      $game->setActiveCards($cardsToSet);

      $winnerPlayer = $game->findRoundWinner($game->getActiveCards());

      $this->assertEquals($game->getPlayers()[1], $winnerPlayer);
   
   }


   public function test_add_score_to_round_winner(){
      
      $game = new AutomaticGame();
      $game->setupGame(4);


      $lastPlayedCards = $game->playRound(); //it uses the private method addScoreToRoundWinner.
      $roundWinner = $game->findRoundWinner($lastPlayedCards);

      $this->assertEquals(1, $roundWinner->getScore());
      
   }
   
   public function test_find_game_winner(){

      $game = new AutomaticGame();
      $game->setupGame(4);

      $game->getPlayers()[0]->setScore(3);
      $game->getPlayers()[1]->setScore(2);
      $game->getPlayers()[2]->setScore(1);

      $winningPlayer = $game->findGameWinner();


      $this->assertEquals($game->getPlayers()[0], $winningPlayer);

      $game->getPlayers()[0]->setScore(1);
      $game->getPlayers()[1]->setScore(5);
      $game->getPlayers()[2]->setScore(1);

      $winningPlayer = $game->findGameWinner();


      $this->assertEquals($game->getPlayers()[1], $winningPlayer);


   }

   public function test_cannot_find_game_winner_when_tie(){

      $game = new AutomaticGame();
      $game->setupGame(4);

      $game->getPlayers()[0]->setScore(3);
      $game->getPlayers()[1]->setScore(3);
      $game->getPlayers()[2]->setScore(1);

      $winningPlayer = $game->findGameWinner();
      
      $this->assertNull($winningPlayer);


   }
   
   
    

}
