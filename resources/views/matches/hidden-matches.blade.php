@extends('layouts.app')

@section('title', __('messages.hidden_matches'))

@section('content')
    @if(session('message'))
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle"></i>
            {{session('message')}}
        </div>
    @endif

    <h1 class="text-center">{{__('messages.hidden_matches')}}</h1>

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
                <th scope="col">{{__('messages.delete')}}</th>
                <th scope="col">{{__('messages.update')}}</th>
                <th scope="col">{{__('messages.public')}}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($matches as $index => $match)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $match->home }}</td>
                    <td>{{ $match->away }}</td>
                    <td>{{ $match->start }}</td>
                    <td>{{ $match->end }}</td>
                    <td>{{ $match->win }} - {{ $match->draw }} - {{ $match->lost }}</td>
                    <td>{{ $match->stop_bet }}</td>
                    <td>
                        <button type="submit" name="delete" class="btn btn-danger btn-sm" value="{{ $match->id }}"><i
                                class="far fa-trash-alt"></i></button>
                    </td>
                    <td><a href="{{ route('matches.edit', $match->id) }}" class="btn btn-primary btn-sm"><i
                                class="fas fa-pencil-alt"></i></a></td>
                    <td>
                        <button type="submit" name="public" class="btn btn-success btn-sm" value="{{ $match->id }}"><i
                                class="fas fa-unlock"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </form>
@endsection
