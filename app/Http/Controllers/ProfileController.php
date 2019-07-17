<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Http\Requests\UpdateProfileRequest;
use App\Match;
use App\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    protected $user, $match, $bet;

    public function __construct(User $user, Match $match, Bet $bet)
    {
        $this->user = $user;
        $this->match = $match;
        $this->bet = $bet;
    }

    //hiển thị trang cá nhân của user
    public function index(User $user)
    {
        $bets = $this->bet->getBetsByUserID($user->id);
        $matches = $this->match->getMatchesByBets($bets);

        return view('profile.profile', ['user' => $user, 'bets' => $bets, 'matches' => $matches]);
    }

    //sửa thông tin cá nhân
    public function edit(UpdateProfileRequest $request, User $user)
    {
        $data = $request->all();
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            array_splice($data, 4);
        }
        $user->updateProfileFromDB($data);

        return back()->with('message', 'Updated profile successfully');
    }
}

