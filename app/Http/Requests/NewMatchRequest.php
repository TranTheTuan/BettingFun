<?php

namespace App\Http\Requests;

use App\Rules\StopBetRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class NewMatchRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'home' => ['required', 'max:20', 'different:away'],
            'away' => 'required|max:20|different:home',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
            'stop_bet' => ['required', 'date', 'before_or_equal:start', new StopBetRule],
            'win' => 'required|numeric',
            'lost' => 'required|numeric',
            'draw' => 'required|numeric'
        ];
    }
}
