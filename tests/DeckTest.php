<?php
use PHPUnit\Framework\TestCase;
use App\Deck;
use App\Card;
use App\Player;

final class DeckTest extends TestCase
{
    
    
   public function test_instantiate_deck()
   {
       $deck = new Deck();
       $this->assertIsArray($deck->cards);
       $this->assertEquals(count($deck->cards), 52);
       $this->assertInstanceOf(Card::class, $deck->cards[0]);
   }

   public function test_shuffle_deck()
   {
       $deck = new Deck();
       $shuffledDeck = $deck->shuffle();
       $this->assertNotEquals($shuffledDeck, $deck);
       $this->assertNotEquals($shuffledDeck->cards[0], $deck->cards[0]);
       $this->assertNotEquals($shuffledDeck->cards[16], $deck->cards[16]);

   }

   public function test_distribute_cards_to_players()
   {
       $deck = new Deck();
       $players = [new Player(), new Player()];
       $playersWithCards = $deck->distributeCards($players);
       $this->assertNotEquals(0, count($playersWithCards[0]->getCards()));
       $this->assertFalse($playersWithCards[0]->getCards() == $playersWithCards[1]->getCards());
       $this->assertFalse($playersWithCards[0]->getCards()[0] == $playersWithCards[1]->getCards()[0]);
       $this->assertFalse($playersWithCards[0]->getCards()[5] == $playersWithCards[1]->getCards()[5]);
       $this->assertTrue(count($playersWithCards[0]->getCards()) == count($playersWithCards[1]->getCards()));
      

   }
    

}
