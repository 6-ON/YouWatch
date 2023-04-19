<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Video extends Model
{
    use HasFactory, HasTags;

    protected $guarded = [];
    protected $with = ['user', 'tags'];
    protected $withCount = ['likes', 'comments'];
    protected $appends = ['user_reaction'];
    // protected $hidden = ['user_id', 'tags.pivot'];

    //boot method
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Scopes\Tags);
        static::addGlobalScope(new Scopes\Filter);
        static::addGlobalScope('notBanned',fn($query) => $query->notBanned());
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // add isLiked type Eloquent/Casts/Attribute
    public function userReaction(): Attribute
    {
        return new Attribute(function () {
            if (auth()->check()) {
                return $this->reactions()->where('user_id', auth()->id())->first();
            }
            return null;
        });
    }



    public function reactions(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->reactions()->where('isLiked', true);
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class)->latest();
    }

    public function ban(){
        $this->update(['banned_at' => now()]);
    }
    public function unban(){
        $this->update(['banned_at' => null]);
    }
    public function scopeBanned($query){
        return $query->whereNotNull('banned_at');
    }
    public function scopeNotBanned($query){
        return $query->whereNull('banned_at');
    }
}
