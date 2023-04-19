<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = [ 'is_subscribed_to'];
    public function history()
    {
        return $this->belongsToMany(Video::class, History::class)
            ->withTimestamps();
    }
    public function lastWatchedVideo()
    {
        return $this->history()->orderByPivot('created_at', 'desc')->first();
    }
    public function videos()
    {
        return $this->hasMany(Video::class);
    }
    // subscribers relationship
    public function subscribers()
    {
        return $this->belongsToMany(User::class, Subscription::class, 'user_id', 'subscriber_id');
    }
    // subscriptions relationship
    public function subscriptions()
    {
        return $this->belongsToMany(User::class, Subscription::class, 'subscriber_id', 'user_id');
    }
    // get subscriptions videos
    public function subscriptionsVideos()
    {
        return Video::whereIn('user_id', $this->subscriptions()->pluck('users.id'))->latest();
        // return $this->hasManyThrough(Video::class,User::class,'id','user_id');
    }
    // // subscribers count
    // public function subscribersCount(): Attribute
    // {
    //     return new Attribute(fn () => $this->subscribers()->count());
    // }
    // is subscribed 
    public function isSubscribedTo(): Attribute
    {
        return new Attribute(function () {
            return auth()->check() ?
                $this->subscribers()->where('subscriber_id', auth()->id())->exists() :
                false;
        });
    }
}
