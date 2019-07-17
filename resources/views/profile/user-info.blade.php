@include('profile.update-profile')

<div class="offset-md-1 col-md-5">
    <p><strong>{{__('messages.username')}}:</strong> {{ $user->username }}</p>
    <p><strong>{{__('messages.email')}}:</strong> {{ $user->email }}</p>
    <p>
        <strong>{{__('messages.balance')}}:</strong>(<i class="fas fa-dollar-sign"></i>){{ $user->balance }}
        @if($user->balance > 5000)
            <small class="text-success"><i class="fas fa-arrow-up"></i>{{$user->balance - 5000}}</small>
        @else
            <small class="text-danger"><i class="fas fa-arrow-down"></i>{{5000 - $user->balance}}</small>
        @endif
    </p>
    @if($user->balance < 10)
        <small class="text-danger">{{__('messages.balance_warning')}}</small>
    @endif
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#profileModal" data-whatever="@fat">
        {{__('messages.update')}}
    </button>
</div>
