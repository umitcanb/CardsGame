<?php
use PHPUnit\Framework\TestCase;
use App\Game;


final class GameTest extends TestCase
{
    
   public function test_start_game(){
      
      $game = new Game();
      $game->startGame(4);

      $this->assertEquals(count($game->players), 4);
      $this->assertEquals(count($game->players[0]->cards), 13);
      $this->assertNotEquals($game->players[0]->cards, $game->players[1]->cards);
      $this->assertEquals($game->turn_count, 0);

   }
    

}
