<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    /** RELACION CON LAS PREGUNTAS (Question Model) */
    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    /** RELACION CON USUARIO (User Model) */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
