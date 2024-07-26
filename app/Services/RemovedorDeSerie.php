<?php

namespace App\Services;

use App\Episodio;
use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class RemovedorDeSerie
{
    public function removerSerie(int $serieId) : string //<- isso diz que vai retornar uma string
    {
        $nomeSerie= '';
        DB::transaction( function () use($serieId, &$nomeSerie)
        {
            //Buscando série
            $serie = Serie::find($serieId);
            $nomeSerie = $serie->nome;
            $this->removerTemporadas($serie);
            $serie->delete();
        });
        return $nomeSerie;
    }


    private function removerTemporadas(Serie $serie): void
    {
        $serie->temporadas->each(function (Temporada $temporada) { //Para cada temporada
            $this->removerEpisodios($temporada);
            $temporada->delete();
        });

    }


    private function removerEpisodios(Temporada $temporada): void
    {
        $temporada->episodios()->each(function (Episodio $episodio) { //Para cada episodio
            $episodio->delete();
        });

    }
}
