<?php

namespace App\Http\Controllers;

use App\Bet;
use App\Http\Requests\DeleteRequest;
use App\Http\Requests\NewMatchRequest;
use App\Services\BettingService;
use App\User;
use Illuminate\Http\Request;
use App\Match;

class MatchController extends Controller
{
    protected $match, $bet, $user, $bettingService;

    //inject các
    public function __construct(Match $match, User $user, Bet $bet, BettingService $bettingService)
    {
        $this->match = $match;
        $this->user = $user;
        $this->bet = $bet;
        $this->bettingService = $bettingService;
    }

    //hiển thị các trận chưa được công bố
    public function index()
    {
        $matches = $this->match->getAllHiddenFromDB();

        return view('matches.hidden-matches', ['matches' => $matches]);
    }

    //hiển thị các trận đã được công bố
    public function public()
    {
        $matches = $this->match->getAllPublicFromDb();
        $bets_number = $this->bet->getBetsNumberList($matches);

        return view('matches.public-matches', ['matches' => $matches, 'bets_number' => $bets_number, 'i' => 0]);
    }

    //hiển thị form thêm trận mới
    public function showAddMatchForm()
    {
        return view('matches.add-match');
    }

    //lưu trận vừa tạo
    public function store(NewMatchRequest $request)
    {
        $data = $request->all();
        $this->match->storeToDB($data);

        return redirect()->route('matches.index')->with('message', 'added new match successfully');
    }

    //xóa một trận
    public function delete(DeleteRequest $request)
    {
        if ($request->has('delete')) {
            $this->match->deleteFromDB($request->delete);
        }
        if ($request->has('public')) {
            $this->match->publicMatch($request->public);

            return redirect()->route('matches.public')->with('message', 'Match is public successfully');
        }

        return back()->with('message', 'Match is deleted successfully');
    }

    //hiển thị form sửa thông tin trận
    public function showEditForm(Match $match)
    {
        return view('matches.edit-match', ['match' => $match]);
    }

    //cập nhật lại thông tin vừa sửa
    public function update(NewMatchRequest $request, Match $match)
    {
        $data = $request->all();
        $match->updateFromDB($data);

        return redirect()->route('matches.index')->with('message', 'Match is updated successfully');
    }

    //hiển thị thông tin chi tiết 1 trân
    public function show(Match $match)
    {
        $bets = $this->bet->getBetsByMatchID($match->id);
        $users = $this->user->getUsersByBetsFromDB($bets);

        return view('matches.show-match', ['match' => $match, 'bets' => $bets, 'users' => $users, 'i' => 0]);
    }

    //cập nhật kết quả cho trận đã kết thúc
    public function updateResult(Request $request, Match $match)
    {
        $bets = $this->bet->getBetsByMatchID($match->id);
        $users = $this->user->getUsersByBetsFromDB($bets);
        $data = $request->all();
        $match->updateFromDB($data);
        $this->bettingService->calculateGainLoss($bets, $match, $users);

        return back()->with('message', 'Match is updated result successfully');
    }
}
