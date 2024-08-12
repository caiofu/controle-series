<?php

namespace Tests\Feature;

use App\Serie;
use App\Services\CriadorDeSerie;
use App\Services\RemovedorDeSerie;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;
    /** @var  Serie */
    private $serie;
    protected function setUp(): void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie( 'nome da serie', 1,1);
    }

    public function testRemoverUmaSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]); //Verifica primeiro se realmente inseriu
        $removedorDeSerie = new RemovedorDeSerie();
        $nomeDaSerie = $removedorDeSerie->removerSerie($this->serie->id);
        $this->assertIsString($nomeDaSerie);
        $this->assertEquals('nome da serie', $this->serie->nome);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
