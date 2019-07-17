@extends('layouts.app')

@section('title', __('messages.edit_match'))

@section('content')
    <h1 class="text-center">{{__('messages.edit_match')}}</h1>
    <div class="offset-md-2 col-md-8">
        <form method="post" action="{{route('matches.update', $match->id)}}">
            @method('PUT')
            @csrf
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="home">{{__('messages.home')}}</label>

                    <input type="text" class="form-control @error('home') is-invalid @enderror"
                           value="{{ $match->home }}" id="home" name="home" placeholder="Home team" required>

                    @error('home')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md-6">
                    <label for="away">{{__('messages.away')}}</label>

                    <input type="text" class="form-control @error('away') is-invalid @enderror"
                           value="{{ $match->away }}" id="away" name="away" placeholder="Away team" required>

                    @error('away')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="start">{{__('messages.start')}}</label>
                <div class="input-group date" id="datetimepicker1" data-target-input="nearest">

                    <input type="text" class="form-control datetimepicker-input @error('start') is-invalid @enderror"
                           value="{{ $match->start }}" id="start" name="start" placeholder="Start time"
                           data-target="#datetimepicker1" required>
                    <div class="input-group-append" data-target="#datetimepicker1" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>

                    @error('start')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="end">{{__('messages.end')}}</label>
                <div class="input-group date" id="datetimepicker2" data-target-input="nearest">

                    <input type="text" class="form-control datetimepicker-input @error('end') is-invalid @enderror"
                           value="{{ $match->end }}" id="end" name="end" placeholder="End time"
                           data-target="#datetimepicker2" required>
                    <div class="input-group-append" data-target="#datetimepicker2" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>

                    @error('end')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="stop-bet">{{__('messages.stop_bet')}}</label>
                <div class="input-group date" id="datetimepicker3" data-target-input="nearest">

                    <input type="text" class="form-control datetimepicker-input @error('stop-bet') is-invalid @enderror"
                           value="{{ $match->stop_bet }}" id="stop-bet" name="stop_bet" placeholder="Stop betting time"
                           data-target="#datetimepicker3" required>
                    <div class="input-group-append" data-target="#datetimepicker3" data-toggle="datetimepicker">
                        <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>

                    @error('stop-bet')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md">
                    <label for="win">{{__('messages.win')}}</label>

                    <input type="number" class="form-control @error('win') is-invalid @enderror"
                           value="{{ $match->win }}" id="win" name="win" placeholder="Win ratio" min="1" required>

                    @error('win')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md">
                    <label for="draw">{{__('messages.draw')}}</label>

                    <input type="number" class="form-control @error('draw') is-invalid @enderror"
                           value="{{ $match->draw }}" id="draw" name="draw" placeholder="Draw ratio" min="1" required>

                    @error('draw')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group col-md">
                    <label for="lost">{{__('messages.lose')}}</label>

                    <input type="number" class="form-control @error('lost') is-invalid @enderror"
                           value="{{ $match->lost }}" id="lost" name="lost" placeholder="Lost ratio" min="1" required>

                    @error('lost')
                    <span class="invalid-feedback" role="alert">
                        <strong><i class="fas fa-skull-crossbones"></i>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <button type="submit" class="btn btn-primary">{{__('messages.update')}}</button>
        </form>
    </div>
@endsection

