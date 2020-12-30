<?php

namespace App;

class Comment extends Model
{
    protected $with = ['user', 'votes']; //Automatically load the user(relationship) who created the comment

    protected $appends = ['repliesCount'];

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

    public function getRepliesCountAttribute() //getSomethingAttribute -> something like computed property(Vue.js)
    {
        return $this->replies->count();
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'voteable');
    }
}
