@extends('layouts.app')

@section('title', 'Betting Fun')

@section('content')
    <h1 class="text-center text-white">{{__('messages.choose_match')}}</h1>
    <table class="tablesorter">
        <thead class="thead-light">
        <tr>
            <th scope="col">{{__('messages.number')}}</th>
            <th scope="col">{{__('messages.home')}}</th>
            <th scope="col">{{__('messages.away')}}</th>
            <th scope="col">{{__('messages.start')}}</th>
            <th scope="col">{{__('messages.end')}}</th>
            <th scope="col">{{__('messages.ratio')}}</th>
            <th scope="col">{{__('messages.stop_bet')}}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($matches as $index => $match)
            <tr class="clickable-row" data-href="{{ route('betting.show', $match->id) }}">
                <td>{{ $index + 1 }}</td>
                <td>{{ $match->home }}</td>
                <td>{{ $match->away }}</td>
                <td>{{ $match->start }}</td>
                <td>{{ $match->end }}</td>
                <td>{{ $match->win }} - {{ $match->draw }} - {{ $match->lost }}</td>
                <td class="warning-color">{{ $match->stop_bet }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
