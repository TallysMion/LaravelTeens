<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'type',
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

    public function getScore(){
        $score =  User::join('user_activities', 'users.id', 'user_activities.user')
                    ->join('activities', 'user_activities.activity', 'activities.id')
                    ->where('users.id', $this->id)
                    ->select(DB::raw('sum(user_activities.value * activities.value) as score'))
                    ->get()->first()->score;
        return $score==null?0:$score;
    }

    public function getScoreList(){
        return User::join('user_activities', 'users.id', 'user_activities.user')
                    ->join('activities', 'user_activities.activity', 'activities.id')
                    ->where('users.id', $this->id)
                    ->select(DB::raw('(user_activities.value * activities.value) as score'), 'user_activities.created_at as date', 'activities.name as activity')
                    ->get();
    }


}
