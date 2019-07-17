<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class Bet extends Pivot
{
    protected $table = 'bets';

    protected $fillable = [
        'user_id', 'match_id', 'bet_time', 'bet_result', 'bet_money', 'gain', 'loss'
    ];

    public $incrementing = 'true';

    protected $dates = [
        'bet_time'
    ];

    public function getBetResultAttribute($value)
    {
        switch ($value) {
            case 1:
                return 'win';
            case 2:
                return 'draw';
            case 3:
                return 'lose';
        }
        return 'win';
    }

    public function getBetsByUserAndMatchID($match_id) {
        $user_id = Auth::id();
        return $this->where(['match_id' => $match_id, 'user_id' => $user_id])->get();
    }

    public function getBetsByMatchID($match_id)
    {
        return $this->where('match_id', $match_id)->get();
    }

    public function getBetsNumberList(Collection $matches)
    {
        $bets_number = collect();
        foreach ($matches as $match) {
            $count = $this->getBetsNumber($match->id);
            $bets_number->push($count);
        }
        return $bets_number;
    }

    public function getBetsNumber($match_id)
    {
        return Bet::where('match_id', $match_id)->count();
    }

    public function getBetsByUserID($user_id)
    {
        return Bet::where('user_id', $user_id)->get();
    }

    public function updateGainFromDB($gain)
    {
        $this->update(['gain' => $gain]);
    }

    public function updateLossFromDB($loss)
    {
        $this->update(['loss' => $loss]);
    }

    public function storeBetToDB(array $data)
    {
        $this->create($data);
    }
}
