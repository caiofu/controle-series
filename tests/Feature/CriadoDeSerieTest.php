<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\CriadorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CriadoDeSerieTest extends TestCase
{
    use RefreshDatabase;
    public function testCriarSerie()
    {
        $criadorDeSerie = new CriadorDeSerie();
        $nomeSerie = 'Nome de teste';
        $serieCriada = $criadorDeSerie->criarSerie($nomeSerie,1,1);
        $this->assertInstanceOf(Serie::class, $serieCriada); //Verifica se a instancia foi criada
        $this->assertDatabaseHas('series', ['nome' => $nomeSerie]);
        $this->assertDatabaseHas('temporadas', ['serie_id' => $serieCriada->id,'numero' => 1]);
        $this->assertDatabaseHas('episodios', ['numero' => 1]);
    }
}
