<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string //<- isso diz que vai retornar uma string
    {
        //Buscando série
        $serie = Serie::find($serieId);
        $nomeSerie = $serie->nome;
        $serie->temporadas->each(function (Temporada $temporada){ //Para cada temporada
            $temporada->episodios()->each(function (Episodio $episodio){ //Para cada episodio
                $episodio->delete();
            });
            $temporada->delete();
        });
        $serie->delete();

        return $nomeSerie;
    }
}
