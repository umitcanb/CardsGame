<?php
use PHPUnit\Framework\TestCase;
use App\Game;
use App\Card;
use App\Player;


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

   public function test_play_an_automatic_round(){
      $game = new Game();

      $game->startGame(4, "Ümit");
      $this->active_cards = $game->playAutomaticRound();

      $this->assertEquals($game->active_cards, $this->active_cards);
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
   
   public function test_find_round_winner(){

      $game = new Game();
      $game->startGame(4, "Ümit");

      $game->active_cards = [new Card(["red","♥"], "A"), new Card(["red","♥"], "1"), new Card(["red","♥"], "2"), new Card(["red","♥"], "J")];

      $winnerPlayer = $game->findRoundWinner($game->active_cards);
      
      $this->assertEquals($game->players[3], $winnerPlayer);


      $game = new Game();
      $game->startGame(4, "Ümit");

      $game->active_cards = [new Card(["red","♥"], "10"), new Card(["red","♦"], "10"), new Card(["black", "♠"], "10"), new Card(["black","♣"], "10")];

      $winnerPlayer = $game->findRoundWinner($game->active_cards);

      $this->assertEquals($game->players[0], $winnerPlayer);
      

      $game = new Game();
      $game->startGame(4, "Ümit");

      $game->active_cards = [new Card(["red","♥"], "2"), new Card(["red","♦"], "Q"), new Card(["black", "♠"], "Q"), new Card(["black","♣"], "10")];

      $winnerPlayer = $game->findRoundWinner($game->active_cards);

      $this->assertEquals($game->players[1], $winnerPlayer);
   
   }


   public function test_add_score_to_round_winner(){
      
      $game = new Game();
      $game->startGame(4, "Ümit");


      $lastPlayedCards = $game->playAutomaticRound(); //it uses the private method addScoreToRoundWinner.
      $roundWinner = $game->findRoundWinner($lastPlayedCards);

      $this->assertEquals(1, $roundWinner->score);
      
   }
   
   public function test_find_game_winner(){

      $game = new Game();
      $game->startGame(4, "Ümit");

      $game->players[0]->score = 3;
      $game->players[1]->score = 2;
      $game->players[2]->score = 1;

      $winningPlayer = $game->findGameWinner();


      $this->assertEquals($game->players[0], $winningPlayer);

      $game->players[0]->score = 1;
      $game->players[1]->score = 5;
      $game->players[2]->score = 1;

      $winningPlayer = $game->findGameWinner();


      $this->assertEquals($game->players[1], $winningPlayer);


   }

   public function test_cannot_find_game_winner_when_tie(){

      $game = new Game();
      $game->startGame(4, "Ümit");

      $game->players[0]->score = 3;
      $game->players[1]->score = 3;
      $game->players[2]->score = 1;

      $winningPlayer = $game->findGameWinner();
      
      $this->assertNull($winningPlayer);


   }
   
   
    

}
