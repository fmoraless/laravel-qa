<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Question extends Model
{
    protected $fillable = [
        'title', 'body',
    ];

    //La pregunta pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //Mutator
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = \str_slug($value);
    }
}
