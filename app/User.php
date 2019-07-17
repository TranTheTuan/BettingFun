<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password', 'balance'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $attributes = [
        'balance' => 5000,
        'role' => 'user'
    ];

    public function match()
    {
        return $this->belongsToMany('App\Match', 'bets')
            ->using('App\Bet')
            ->withPivot([
                'bet_time', 'bet_money', 'bet_result'
            ])->withTimestamps();
    }

    public function hasRole($role)
    {
        return $this->role == $role;
    }

    public function getUsersByBetsFromDB(Collection $bets)
    {
        $users = collect();
        foreach ($bets as $bet) {
            $user = $this->find($bet->user_id);
            $users->push($user);
        }
        return $users;
    }

    public function updateBalanceFromDB($value)
    {
        $balance = User::find($this->id)->balance + $value;
        $this->update(['balance' => $balance]);
    }

    public function updateProfileFromDB(array $data)
    {
        $this->update($data);
    }
}
