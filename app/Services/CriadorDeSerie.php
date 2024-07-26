<?php

namespace App\Services;

use App\Serie;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(string $nomeSerie, int $qtdTemporadas, int $epPorTemproada):Serie
    {
        $serie = null;
        DB::beginTransaction();
            $serie = Serie::create(['nome' => $nomeSerie]);
            $this->criaTemporadas($qtdTemporadas, $serie, $epPorTemproada);
        DB::commit();

        return $serie;
    }

    /**
     * @param int $epPorTemproada
     * @param $temporada
     */
    public function criaEpisodios(int $epPorTemproada, $temporada): void
    {
        for ($j = 1; $j <= $epPorTemproada; $j++) {
            $temporada->episodios()->create(['numero' => $j]);
        }
    }

    /**
     * @param int $qtdTemporadas
     * @param $serie
     * @param int $epPorTemproada
     */
    public function criaTemporadas(int $qtdTemporadas, $serie, int $epPorTemproada): void
    {
        for ($i = 1; $i <= $qtdTemporadas; $i++) {
            $temporada = $serie->temporadas()->create(['numero' => $i]);

            $this->criaEpisodios($epPorTemproada, $temporada);
        }
    }


}
