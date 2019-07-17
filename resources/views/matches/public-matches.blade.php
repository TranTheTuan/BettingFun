@extends('layouts.app')

@section('title', __('messages.public_matches'))

@section('content')
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i>
            {{session('message')}}
        </div>
    @endif

    <h1 class="text-center">{{__('messages.public_matches')}}</h1>

    <form method="post" action="{{ route('matches.delete') }}">
        @csrf
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
                <th scope="col">{{__('messages.bet_number')}}</th>
                <th scope="col">{{__('messages.delete')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($matches as $index => $match)
                <tr class="clickable-row" data-href="{{ route('matches.show', $match->id) }}">
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $match->home }}</td>
                    <td>{{ $match->away }}</td>
                    <td>{{ $match->start }}</td>
                    <td>{{ $match->end }}</td>
                    <td>{{ $match->win }} - {{ $match->draw }} - {{ $match->lost }}</td>
                    <td>{{ $match->stop_bet }}</td>
                    <td>{{ $bets_number[$i++]}}</td>
                    <td>
                        <button type="submit" id="delete-button" name="delete"
                                class="btn btn-danger btn-sm @error('delete') is-invalid @enderror"
                                value="{{ $match->id }}"><i class="far fa-trash-alt"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        @error('delete')
            <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
                {{__('messages.delete_error')}}
            </div>
        @enderror
    </form>
@endsection
