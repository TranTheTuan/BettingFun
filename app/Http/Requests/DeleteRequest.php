<?php

namespace App\Http\Requests;

use App\Bet;
use App\Rules\DeleteRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class DeleteRequest extends FormRequest
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
    public function rules(Bet $bet)
    {
        return [
            'delete' => [
                new DeleteRule($bet)
            ]
        ];
    }
}
