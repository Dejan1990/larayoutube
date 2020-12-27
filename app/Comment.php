<?php

namespace App;

class Comment extends Model
{
    protected $with = ['user']; //Automatically load the user(relationship) who created the comment

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies() // zato sto ime relationship-a nije po konvenciji moramo u zagradi da definisemo foreign_key (Comment::class, 'comment_id') -> 'comment_id'
    {
        return $this->hasMany(Comment::class, 'comment_id')->whereNotNull('comment_id');
    }
}
