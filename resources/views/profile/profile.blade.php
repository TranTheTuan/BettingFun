@extends('layouts.app')

@section('title', 'Profile')

@section('content')
    <div class="row" style="margin-top: 120px">
        <div class="col-2 border-right border-primary">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                   aria-controls="v-pills-home" aria-selected="true">
                    {{__('messages.profile')}}
                </a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                   aria-controls="v-pills-profile" aria-selected="false">
                    {{__('messages.bet_history')}}
                </a>
            </div>
        </div>
        <div class="col-10">
            <div class="tab-content text-white" id="v-pills-tabContent">
                <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                     aria-labelledby="v-pills-home-tab">
                    @include('profile.user-info')
                </div>
                <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    @include('profile.bets-history')
                </div>
            </div>
        </div>
    </div>

@endsection
