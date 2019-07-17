<?php

namespace App\Http\Requests;

use App\Rules\BettingRule;
use App\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class BettingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::user()->role == 'user';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bet_result' => 'required|numeric',
            'bet_money' => ['required', 'numeric', 'min:10', new BettingRule]
        ];
    }

    public function messages()
    {
        return [
            'bet_result.numeric' => 'You must choose a result'
        ];
    }
}
