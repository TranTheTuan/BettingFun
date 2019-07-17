@extends('layouts.app')

@section('title', $match->home.' - '.$match->away)

@include('layouts.update-result')

@section('content')

    <h1 class="text-center">{{ $match->home }} - {{ $match->away }}</h1>

    @if(!isset($match->home_score) && $match->end->lt(now()))
        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#resultModal"
                data-whatever="@fat">
            Update Result
        </button>
    @endif
    @if(isset($match->home_score))
        <p class="text-center">{{$match->home_score}} - {{ $match->away_score }}</p>
    @else
        <p class="text-center text-danger">{{__('messages.result_warning')}}</p>
    @endif
    <table class="tablesorter">
        <thead class="thead-light">
        <tr>
            <th scope="col">{{__('messages.number')}}</th>
            <th scope="col">{{__('messages.username')}}</th>
            <th scope="col">{{__('messages.bet_result')}}</th>
            <th scope="col">{{__('messages.bet_money')}}</th>
            <th scope="col">{{__('messages.gain_loss')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($bets as $index => $bet)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $users[$i++]->username }}</td>
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
@endsection
