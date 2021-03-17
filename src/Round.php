<?php
namespace App;
use App\Game;
use App\Player;

final class Round{ 

    private $activeCards;

    function __construct(Array $activeCards = []) {

        $this->activeCards = $activeCards;
      
    }

    public function getActiveCards(){
        return $this->activeCards;
    }
  
    public function setActiveCards(Array $cards){
        foreach ($cards as &$card){
          array_push($this->activeCards, $card);
        }
        return $this->activeCards;
    }

    public function playRound(Game $game){

   //     $this->activeCards = []; //gerek kalmadı
        foreach ($game->getPlayers() as &$player){
            $playedCard = $player->play();
            $game->addHistoryCard($playedCard);
            $game->addHistoryRound($this);
            array_push($this->activeCards, $playedCard);
        }
        $game->increaseTurnCount();
        $roundWinner = $this->findRoundWinner($this->activeCards, $game);
        self::addScoreToRoundWinner($roundWinner);

        return $this->activeCards;

    }



    public function findRoundWinner(Array $lastPlayedCards, Game $game){

        $symbols =["♥", "♦", "♣", "♠"];
        $values = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "10", "J", "Q", "K"];
        $winnerPlayerIndex = 0;
        $winnerCard = $lastPlayedCards[0];
        
        for ($count = 0 ; $count < count($game->getPlayers()); $count++){
        if (array_search($lastPlayedCards[$count]->getValue(), $values) > array_search($winnerCard->getValue(), $values)){
            $winnerPlayerIndex = $count;
            $winnerCard = $lastPlayedCards[$count];
        }
        if ($lastPlayedCards[$count]->getValue() == $winnerCard->getValue()){
            if (array_search($lastPlayedCards[$count]->getSymbol()->getShape(), $symbols) < array_search($winnerCard->getSymbol()->getShape(), $symbols)){
            $winnerPlayerIndex = $count;
            $winnerCard = $lastPlayedCards[$count];
            }
        }
        }
        
        print("{$game->getPlayers()[$winnerPlayerIndex]->name} has won this round with the card {$winnerCard->getValue()}, {$winnerCard->getSymbol()->getShape()}."."\n");
        return $game->getplayers()[$winnerPlayerIndex];
        
    }

    private static function addScoreToRoundWinner(Player $winnerPlayer){
        $newScore = $winnerPlayer->getScore += 1;
        $winnerPlayer->setScore($newScore);
        return $winnerPlayer->getScore();
    }
}