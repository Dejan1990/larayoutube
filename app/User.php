<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    public $incrementing = false; //posto nasledjujemo Authenticatable, ne mozemo i nas Model(BaseModel), pa ovo ostaje ovde

    protected static function boot() //posto nasledjujemo Authenticatable, ne mozemo i nas Model(BaseModel), pa ovo ostaje ovde
    {
        parent::boot();

        static::creating(function ($model) {
            //$model->id = Str::uuid(); // Moze ovako, ali nije najbolje

            $model->{$model->getKeyName()} = (string) Str::uuid(); // return primaryKey // if overated, still work
        });
    }

    public function channel()
    {
        return $this->hasOne(Channel::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function toggleVote($entity, $type) {
        $vote = $entity->votes->where('user_id', $this->id)->first(); //proveravamo da li je user vec glasao

        if ($vote) {
            $vote->update([
                'type' => $type
            ]);

            return $vote->refresh();
        } else {
            return $entity->votes()->create([
                'type' => $type,
                'user_id' => $this->id
            ]);
        }
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
}
