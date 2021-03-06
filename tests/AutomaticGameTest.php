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
   
   public function test_play_automatic_game_when_players_have_equal_number_of_cards(){
      $game = new AutomaticGame();
      $game->executeGame(4);

      $this->assertEquals(4, count($game->findLastRound()->getActiveCards()));
      $this->assertEquals(52, count($game->getHistoryCards()));
      $this->assertEquals(52 / 4, $game->getTurnCount());

   }

   public function test_execute_automatic_game_when_players_do_not_have_equal_number_of_cards(){
      $game = new AutomaticGame();
      $game->executeGame(5);

      $this->assertEquals(5, count($game->findLastRound()->getActiveCards()));
      $this->assertEquals(50, count($game->getHistoryCards()));
      $this->assertEquals(10, $game->getTurnCount());
      $this->assertNotNull($game->findGameWinner()); //bazen geçiyor bazen geçmiyor


      $game = new AutomaticGame();
      $game->executeGame(7);

      $this->assertEquals(7, count($game->findLastRound()->getActiveCards()));
      $this->assertEquals(49, count($game->getHistoryCards()));
      $this->assertEquals(7, $game->getTurnCount());
      $this->assertNotNull($game->findGameWinner()); //bazen geçiyor bazen geçmiyor

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

   public function test_multiple_winners_when_tie(){

      $game = new AutomaticGame();
      $game->setupGame(4);

      $game->getPlayers()[0]->setScore(3);
      $game->getPlayers()[1]->setScore(3);
      $game->getPlayers()[2]->setScore(1);

      $winningPlayer = $game->findGameWinner();
      
      $this->assertTrue(1 < count($winningPlayer));


   }
   
   
    

}
