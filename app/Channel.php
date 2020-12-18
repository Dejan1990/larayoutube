<?php

namespace App;

use Spatie\MediaLibrary\Models\Media;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Channel extends Model implements HasMedia
{
    use HasMediaTrait;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function image()  // Ovo je odgovor iz osme lekcije, pokazuje sliku  
    {     
        if ($this->media->first()) {  
            $Fan = $this->getFirstMediaUrl('images', 'thumb');   
            $Tan = str_replace("http://localhost","","$Fan");         
            return $Tan;    
        }

        return null; 
    }

   /* public function image() //Ovo je Katijevo, ali nije pokazivalo sliku
    {
        if ($this->media->first()) {
            return $this->media->first()->getFullUrl('thumb');
        }

        return null;
    }*/

    public function editable()
    {
        if (! auth()-> check()) return false;

        return $this->user_id === auth()->user()->id;
    }

    public function registerMediaConversions(?Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(100)
            ->height(100);
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
}
