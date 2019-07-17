<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Http\Requests\BettingRequest;
use App\Match;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected $user, $bet, $match;

    public function __construct(User $user, Bet $bet, Match $match)
    {
        $this->user = $user;
        $this->bet = $bet;
        $this->match = $match;
    }

    //trang chủ
    public function home()
    {
        return view('layouts.home');
    }

    //hiển thị danh sách trận đã public
    public function index()
    {
        $matches = $this->match->getAllPublicFromDb();

        return view('betting.bets-list', ['matches' => $matches]);
    }

    //tiến hành đặt cược
    public function store(BettingRequest $request, Match $match)
    {
        $data = $request->all();
        $user = Auth::user();
        $match_id = $match->id;
        $user_id = $user->id;
        $data['match_id'] = $match_id;
        $data['user_id'] = $user_id;
        $data['bet_time'] = now();
        $user->updateBalanceFromDB(-$data['bet_money']);
        $this->bet->storeBetToDB($data);

        return back()->with('message', 'bet successfully');
    }

    //hiển thị trang đặt cược
    public function show(Match $match)
    {
        $bets = $this->bet->getBetsByUserAndMatchID($match->id);

        return view('betting.betting', ['match' => $match, 'bets' => $bets]);
    }
}

