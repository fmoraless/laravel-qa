<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

use App\User;
use App\Answer;


class Question extends Model
{
    use VotableTrait;

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
        $this->attributes['slug'] = Str::slug($value);
    }

    //Accessors
    public function getUrlAttribute()
    {
        return route("questions.show", $this->slug);
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getStatusAttribute()
    {
        if($this->answers_count > 0){
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }
    public function getBodyHtmlAttribute()
    {
        return \Parsedown::instance()->text($this->body);
    }

    /** RELACION CON LAS RESPUESTAS (Answer Model) */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function acceptBestAnswer(Answer $answer)
    {
        $this->best_answer_id = $answer->id;
        $this->save();

    }

    public function favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
        /*
         * Se usa el segundo argumento, cuando no utilizamos la convención para relaciones
         * muchos muchos que tiene laravel, que es ordenar las 2 tablas alfabeticamente y en sigular. sería question_user. Por esta razón y ocmo hemos usuado
         * la tabla 'favorites', debemos indicar como 2° parametro.
        */
    }

    public function isFavorited()
    {
        return $this->favorites()->where('user_id', auth()->id())->count() > 0;
    }

    public function getIsFavoritedAttribute()
    {
        return $this->isFavorited();
    }

    public  function getFavoritesCountAttribute()
    {
        return $this->favorites->count();
    }
    
}
