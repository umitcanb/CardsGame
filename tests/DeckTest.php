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
       $this->assertIsArray($deck->getCards());
       $this->assertEquals(count($deck->getCards()), 52);
       $this->assertInstanceOf(Card::class, $deck->getCards()[0]);
   }

   public function test_shuffle_deck()
   {
       $deck = new Deck();
       $cardsBeforeShuffle = $deck->getCards();
       $shuffledDeck = $deck->shuffle();
       $this->assertNotEquals($shuffledDeck->getCards(), $cardsBeforeShuffle);
       //$this->assertNotEquals($shuffledDeck->getCards()[0], $cardsBeforeShuffle[0]); //there is a little possibility of coincidence
      // $this->assertNotEquals($shuffledDeck->getCards()[16], $cardsBeforeShuffle[16]); //there is a little possibility of coincidence

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
