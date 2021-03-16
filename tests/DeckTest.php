<?php
use PHPUnit\Framework\TestCase;
use App\Deck;
use App\Card;
use App\AutomaticPlayer;

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

   public function test_distribute_cards_to_players_when_players_have_equal_number_of_cards()
   {
       $deck = new Deck();
       $players = [new AutomaticPlayer(), new AutomaticPlayer()];
       $playersWithCards = $deck->distributeCards($players);
       $this->assertNotEquals(0, count($playersWithCards[0]->getCards()));
       $this->assertFalse($playersWithCards[0]->getCards() == $playersWithCards[1]->getCards());
       $this->assertFalse($playersWithCards[0]->getCards()[0] == $playersWithCards[1]->getCards()[0]);
       $this->assertFalse($playersWithCards[0]->getCards()[5] == $playersWithCards[1]->getCards()[5]);
       $this->assertTrue(count($playersWithCards[0]->getCards()) == count($playersWithCards[1]->getCards()));
      

   }
   
   public function test_distribute_cards_to_players_when_players_do_not_have_equal_number_of_cards(){

        $deck = new Deck();
        $players = [new AutomaticPlayer(), new AutomaticPlayer(), new AutomaticPlayer(), new AutomaticPlayer(), new AutomaticPlayer()];
        $playersWithCards = $deck->distributeCards($players);
        $this->assertNotEquals(0, count($playersWithCards[0]->getCards()));
        $this->assertFalse($playersWithCards[0]->getCards() == $playersWithCards[1]->getCards());
        $this->assertFalse($playersWithCards[0]->getCards()[0] == $playersWithCards[1]->getCards()[0]);
        $this->assertFalse($playersWithCards[0]->getCards()[5] == $playersWithCards[1]->getCards()[5]);

        $this->assertTrue(count($playersWithCards[0]->getCards()) == count($playersWithCards[1]->getCards()));
        $this->assertFalse(count($playersWithCards[0]->getCards()) == count($playersWithCards[4]->getCards()));
        $this->assertEquals(10, count($playersWithCards[4]->getCards()));
        $this->assertEquals(11, count($playersWithCards[0]->getCards()));



   }

    

}
