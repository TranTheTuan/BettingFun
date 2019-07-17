@extends('layouts.app')

@section('title', 'Betting')

@section('content')
    <div class="row" style="height: 100px">
        <div class="col-md-8 border-right">
            <h1 class="text-center text-white">{{ $match->home }} - {{ $match->away }}</h1>
            @if(isset($match->home_score))
                <p class="text-center">{{$match->home_score}} - {{ $match->away_score }}</p>
            @else
                <p class="text-center text-danger">{{__('messages.result_warning')}}</p>
            @endif
            <h5 class="text-center">Your Previous Bets</h5>
            <table class="tablesorter">
                <thead class="thead-light">
                <tr>
                    <th scope="col">{{__('messages.number')}}</th>
                    {{--<th scope="col">{{__('messages.username')}}</th>--}}
                    <th scope="col">{{__('messages.bet_result')}}</th>
                    <th scope="col">{{__('messages.bet_money')}}</th>
                    <th scope="col">{{__('messages.gain_loss')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($bets as $index => $bet)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        {{--<td>{{ $users[$i++]->username }}</td>--}}
                        <td>{{ $bet->bet_result }}</td>
                        <td>{{ $bet->bet_money }}</td>
                        @if(isset($match->home_score))
                            @if(isset($bet->gain))
                                <td>{{ $bet->gain }}</td>
                            @elseif(isset($bet->loss))
                                <td>{{ $bet->loss }}</td>
                            @endif
                        @else
                            <td>{{__('messages.na')}}</td>
                        @endif
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <div class="col-md-4">
            @if(now()->lt($match->stop_bet))
                <h1 class="text-center text-white">{{__('messages.let_go_bet')}}</h1>
                <form method="post" action="{{ route('betting.store', $match->id) }}">
                    @csrf
                    <div class="form-group">
                        <label for="bet-result" class="text-white">{{__('messages.bet_result')}}</label>
                        <select class="form-control @error('bet_result') is-invalid @enderror" id="bet-result" name="bet_result">
                            <option selected>{{__('messages.choose_result')}}</option>
                            <option value="1">{{__('messages.win')}}</option>
                            <option value="2">{{__('messages.draw')}}</option>
                            <option value="3">{{__('messages.lose')}}</option>
                        </select>

                        @error('bet_result')
                        <span class="invalid-feedback" role="alert">
                                <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="bet-money" class="text-white">{{__('messages.bet_money')}}</label>
                        <input type="number" class="form-control @error('bet_money') is-invalid @enderror"
                               id="bet-money" name="bet_money"
                               placeholder="Bet Money" min="10">

                        @error('bet_money')
                            <span class="invalid-feedback" role="alert">
                                <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>
                    <button type="submit" class="btn btn-primary">{{__('messages.submit')}}</button>
                </form>
            @else
                <div class="text-center">
                    <h3 class="text-danger">{{__('messages.closed_warning_1')}}<i class="far fa-sad-tear"></i></h3>
                    <p class="text-dark">{{__('messages.closed_warning_2')}}</p>
                </div>
            @endif
        </div>
    </div>
@endsection
