<?php

namespace App\Rules;

use App\Bet;
use App\Match;
use App\User;
use Illuminate\Contracts\Validation\Rule;

class DeleteRule implements Rule
{
    protected $bet;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Bet $bet)
    {
        $this->bet = $bet;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string $attribute
     * @param  mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $count = $this->bet->getBetsNumber($value);
        return $count == 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You cant delete this match';
    }
}
