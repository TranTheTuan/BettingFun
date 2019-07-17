<h2 class="text-center">Bets History</h2>

<table id="myTable" class="tablesorter">
    <thead class="thead-light">
    <tr>
        <th scope="col">{{__('messages.number')}}</th>
        <th scope="col">{{__('messages.bet_time')}}</th>
        <th scope="col">{{__('messages.home')}}</th>
        <th scope="col">{{__('messages.away')}}</th>
        <th scope="col">{{__('messages.result')}}</th>
        <th scope="col">{{__('messages.ratio')}}</th>
        <th scope="col">{{__('messages.bet_result')}}</th>
        <th scope="col">{{__('messages.bet_money')}}</th>
        <th scope="col">{{__('messages.gain_loss')}}</th>
    </tr>
    </thead>
    <tbody>
    @foreach($bets as $index => $bet)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $bet->bet_time }}</td>
            <td>{{ $matches[$index]->home }}</td>
            <td>{{ $matches[$index]->away }}</td>
            @if(isset($matches[$index]->home_score))
                <td>{{ $matches[$index]->home_score }} - {{ $matches[$index]->away_score }}</td>
            @else
                <td>N/A</td>
            @endif
            <td>{{ $matches[$index]->win }} - {{ $matches[$index]->draw }} - {{ $matches[$index]->lost }}</td>
            <td>{{ $bet->bet_result }}</td>
            <td>{{ $bet->bet_money }}</td>
            @if(isset($bet->gain))
                <td>{{ $bet->gain }}</td>
            @elseif(isset($bet->loss))
                <td>{{ $bet->loss }}</td>
            @else
                <td>N/A</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>

