@extends('layouts.app')

@section('title', 'Betting Fun')

@section('content')
    <div class="text-center text-white">
        <h1 class="text-success">Welcome to <strong><i>Betting.com</i></strong></h1>
        <p>{{__('messages.preface')}}</p>
        <blockquote class="blockquote">
            <p class="mb-0">{{__('messages.quote_1')}}</p>
            <footer class="blockquote-footer text-warning">{{__('messages.author_1')}} <cite
                    title="Source Title">{{__('messages.source_1')}}</cite></footer>
        </blockquote>
        <blockquote class="blockquote">
            <p class="mb-0">{{__('messages.quote_2')}}</p>
            <footer class="blockquote-footer text-warning">{{__('messages.author_2')}} <cite
                    title="Source Title">{{__('messages.source_2')}}</cite></footer>
        </blockquote>
        <blockquote class="blockquote">
            <p class="mb-0">{{__('messages.quote_3')}}</p>
            <footer class="blockquote-footer text-warning">{{__('messages.author_3')}} <cite
                    title="Source Title">{{__('messages.source_3')}}</cite></footer>
        </blockquote>
        <a href="{{ route('betting.index') }}" class="btn btn-outline-success">{{__('messages.button_bet_now')}}</a>
    </div>
@endsection
