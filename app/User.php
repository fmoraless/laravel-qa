<?php

namespace App;

use App\Question;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Answer;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        //return route("questions.show", $this->id);
        return '#';
    }

    /** RELACION CON LAS RESPUESTAS (Answer Model) */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }


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

    public function getAvatarAttribute()
    {
        $email = $this->email;
        $size = 32;
        return $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }

    //un usuario puede tener mas de una pregunta como favorita
    public function favorites()
    {
        return $this->belongsToMany(Question::class, 'favorites')->withTimestamps();
        /*
         * Se usa el segundo argumento, cuando no utilizamos la convención para relaciones
         * muchos muchos que tiene laravel, que es ordenar las 2 tablas alfabeticamente y en sigular. sería question_user. Por esta razón y ocmo hemos usuado
         * la tabla 'favorites', debemos indicar como 2° parametro.
        */
    }

    public function voteQuestions()
    {
        return $this->morphedByMany(Question::class, 'votable');
    }

    public function voteAnswers()
    {
        return $this->morphedByMany(Answer::class, 'votable');
    }

    public function voteQuestion(Question $question, $vote)
    {
        $voteQuestions = $this->voteQuestions();
        if ($voteQuestions->where('votable_id', $question->id)->exists()) {
            $voteQuestions->updateExistingPivot($question, ['vote' => $vote]);
        }
        else {
            $voteQuestions->attach($question, ['vote' => $vote]);
        }
        $question->load('votes');
        $downVotes = (int) $question->downVotes()->sum('vote');
        $upVotes = (int) $question->upVotes()->sum('vote');
        $question->votes_count = $upVotes + $downVotes;
        $question->save();
    }
}
