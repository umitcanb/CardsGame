<?php
use PHPUnit\Framework\TestCase;
use App\Player;
use App\Card;

final class PlayerTest extends TestCase
{
    
   public function test_player_plays(){
       
        $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
        $player = new Player($cardsArray);

        $cardPlayed = $player->play();

        $this->assertContains($cardPlayed, $cardsArray);
        $this->assertNotContains($cardPlayed, $player->cards);
        $this->assertContains($cardPlayed, $player->history);

   }
    

}
