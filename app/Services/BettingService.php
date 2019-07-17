<?php
/**
 * Created by IntelliJ IDEA.
 * User: Asus
 * Date: 5/24/2019
 * Time: 10:33 AM
 */

namespace App\Services;

use App\Bet;
use App\Match;
use App\User;
use Illuminate\Support\Collection;

class BettingService
{
    protected $user, $bet, $match;

    public function __construct(User $user, Bet $bet, Match $match)
    {
        $this->user = $user;
        $this->bet = $bet;
        $this->match = $match;
    }

    public function calculateGainLoss(Collection $bets, Match $match, Collection $users)
    {
        $home_score = $match->home_score;
        $away_score = $match->away_score;
        foreach ($bets as $index => $bet) {
            if ($home_score > $away_score) {
                $matchResult = 'win';
                $rate = $match->win;
            } elseif ($home_score == $away_score){
                $matchResult = 'draw';
                $rate = $match->draw;
            } else {
                $matchResult = 'lost';
                $rate = $match->lost;
            }

            if ($bet->bet_result == $matchResult) {
                $gain = $bet->bet_money + $bet->bet_money * $rate;
                $bet->updateGainFromDB($gain);
                $users[$index]->updateBalanceFromDB($gain);
            } else {
                $loss = -$bet->bet_money;
                $bet->updateLossFromDB($loss);
            }
        }
    }
}
