<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    protected  $fillable = ['numero'];
    public $timestamps = false;

    public function episodios()
    {
        return $this->hasMany(Episodio::class); //Tem muitos episodios
    }

    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }

    public function getEpisodiosAssistidos() : Collection
    {
        //Filtra somente os assistidos
        return $this->episodios->filter(function (Episodio $episodio){
           return $episodio->assistido;
        });
    }
}
