<?php
use PHPUnit\Framework\TestCase;
use App\Game;


final class GameTest extends TestCase
{
    
   public function test_start_game(){
      
      $game = new Game();
      $game->startGame(4, "Ümit");

      $this->assertEquals(count($game->players), 4);
      $this->assertEquals(count($game->players[0]->cards), 13);
      $this->assertNotEquals($game->players[0]->cards, $game->players[1]->cards);
      $this->assertEquals($game->turn_count, 0);

      $game2 = new Game();
      $game2->startGame(2, "Ümit");

      $this->assertEquals(count($game2->players), 2);
      $this->assertEquals(count($game2->players[0]->cards), 26);

   }

   public function test_play_a_round(){
      $game = new Game();

      $game->startGame(4, "Ümit");
      $firstRoundPlayedCards = $game->playAutomaticRound();

      $this->assertEquals($game->active_cards, $firstRoundPlayedCards);
      $this->assertEquals(4, count($game->active_cards));
      $this->assertEquals(4, count($game->history_cards));
      $this->assertEquals(1, $game->turn_count);

      $secondRoundPlayedCards = $game->playAutomaticRound();
      $this->assertEquals($game->active_cards, $secondRoundPlayedCards);
      $this->assertEquals(8, count($game->history_cards));
      $this->assertEquals(2, $game->turn_count);

   }
   
   public function test_play_automatic_game(){
      $game = new Game();
      $game->playAutomaticGame(4, "Ümit");

      $this->assertEquals(4, count($game->active_cards));
      $this->assertEquals(52, count($game->history_cards));
      $this->assertEquals(52 / 4, $game->turn_count);

   }
   
   public function test_play_round(){
      $game = new Game();
      $game = $game->startGame(4, "Ümit");

      $game->playRound();

      $this->assertEquals(4, count($game->active_cards));
      $this->assertEquals(4, count($game->history_cards));
      $this->assertEquals(1, $game->turn_count);

      $game->playRound();

      $this->assertEquals(4, count($game->active_cards));
      $this->assertEquals(8, count($game->history_cards));
      $this->assertEquals(2, $game->turn_count);

   }
   
    

}
