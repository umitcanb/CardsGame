<?php
use PHPUnit\Framework\TestCase;
use App\Player;
use App\Card;

final class PlayerTest extends TestCase
{
    
   public function test_player_plays_random(){
       
        $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
        $player = new Player($cardsArray);

        $cardPlayed = $player->playRandomCard();

        $this->assertContains($cardPlayed, $cardsArray);
        $this->assertNotContains($cardPlayed, $player->cards);
        $this->assertContains($cardPlayed, $player->history);

   }

   public function test_show_cards(){

      $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
      $player = new Player($cardsArray);

      $cardShowed = $player->showCards();
      $this->assertEquals($cardShowed, $cardsArray);

   }

   public function test_select_and_play_card(){
      $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
      $player = new Player($cardsArray);

      $selectedCard = $player->play(0);
      $this->assertEquals("A", $selectedCard->value);
      $this->assertEquals("♥", $selectedCard->symbol->shape);
      $this->assertContains($selectedCard, $cardsArray);
      $this->assertNotContains($selectedCard, $player->cards);
      $this->assertContains($selectedCard, $player->history);

      

   }

   public function test_cannot_play_if_selected_card_index_is_out_of_range(){
      $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
      $player = new Player($cardsArray);

      $selectedCard = $player->play(4);
      $this->assertEquals($selectedCard, $player->selectAndPlayCard());
   }

      /* The test below was meatn to test a private method that is already interacted by the public play method that is tested above. 

   public function test_check_if_index_number_is_in_the_range(){

      $cardsArray = [new Card(["red","♥"], "A"), new Card(["red","♦"], "1"), new Card(["black","♠"], "10")];
      $player = new Player($cardsArray);

      $inRange = $player->checkIndexRange(0);
      $this->assertTrue($inRange);

      $inRange = $player->checkIndexRange(4);
      $this->assertFalse($inRange);

   }
   */

    

}
