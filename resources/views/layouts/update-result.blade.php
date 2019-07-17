<div class="modal fade text-dark" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Result</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="post" action="{{ route('matches.update_result', $match->id) }}">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="home-score">{{__('messages.home_score')}}</label>

                            <input type="number" class="form-control @error('home-score') is-invalid @enderror"
                                   id="home-score" name="home_score" placeholder="Home Score" min="0" required>

                            @error('home-score')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="away-score">{{__('messages.away_score')}}</label>

                            <input type="number" class="form-control @error('away') is-invalid @enderror"
                                   id="away-score" name="away_score" placeholder="Away Score" min="0" required>

                            @error('away')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="submit" class="btn btn-primary" value="{{__('messages.update')}}">
                </div>
            </form>
        </div>
    </div>
</div>
