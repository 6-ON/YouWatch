<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Video extends Model
{
    use HasFactory,HasTags;

    protected $guarded = [];
    protected $with = ['user', 'tags'];
    protected $withCount = ['likes', 'comments'];
    // protected $hidden = ['user_id', 'tags.pivot'];

    //boot method
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new Scopes\Tags);
        static::addGlobalScope(new Scopes\Filter);
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    

    public function likes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Like::class)->where('isLiked', true);
    }
    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
    
}
