<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $hidden = ['user_id', 'video_id'];
    protected $with = ['user:id,name,username,image'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
