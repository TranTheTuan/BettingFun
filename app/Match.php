<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Match extends Model
{
    protected $fillable = [
        'home', 'away', 'start', 'end', 'stop_bet', 'win', 'draw', 'lost', 'home_score', 'away_score'
    ];

    protected $dates = [
        'start', 'end', 'open_time', 'stop_bet'
    ];

    protected $attributes = [
        'status' => '0'
    ];

    public function setStartAttribute($value)
    {
        $this->attributes['start'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setEndAttribute($value)
    {
        $this->attributes['end'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function setStopBetAttribute($value)
    {
        $this->attributes['stop_bet'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsToMany('App\User', 'bets');
    }

    public function getAllHiddenFromDB()
    {
        return Match::where('status', 0)->get()->sortBy('start');
    }

    public function getAllPublicFromDb()
    {
        return Match::where('status', 1)->get()->sortBy('start');
    }

    public function getMatchesByBets(Collection $bets)
    {
        $matches = collect();
        foreach ($bets as $bet) {
            $match = Match::find($bet->match_id);
            $matches->push($match);
        }

        return $matches;
    }

    public function storeToDB(array $data)
    {
        Match::create($data);
    }

    public function deleteFromDB($id)
    {
        Match::destroy($id);
    }

    public function updateFromDB(array $data)
    {
        $this->update($data);
    }

    public function publicMatch($id)
    {
        Match::where('id', $id)->update(['status' => 1, 'open_time' => now()]);
    }

}
