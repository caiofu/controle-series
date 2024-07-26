<?php

namespace App\Http\Controllers;

use App\Episodio;
use App\Http\Requests\SeriesFormRequest;
use App\Serie;
use App\Services\RemovedorDeSerie;
use App\Temporada;
use App\Services\CriadorDeSerie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function ListarSeries(Request $request){
        $series = Serie::query()->orderBy('nome')->get();
        $mensagem = $request->session()->get('mensagem');
        return view('series.index',compact('series', 'mensagem'));
    }

    public function create()
    {
        return view('series.create'); //create e acordo com as conveções do laravel
    }

    public function store(SeriesFormRequest  $request, CriadorDeSerie $criadorDeSerie)
    {

      $serie = $criadorDeSerie->criarSerie($request->nome, $request->qtd_temporadas, $request->ep_por_temporada);
        $request->session()->flash ('mensagem', "Série {$serie->id} e suas temporadas e episodios criados com sucesso {$serie->nome}");
     return redirect()->route('listar_series');

    }

    public function destroy(Request $request, RemovedorDeSerie $removedorDeSerie)
    {
        $nomeSerie = $removedorDeSerie->removerSerie($request->id);
        $request->session()->flash('mensagem', "Serie $nomeSerie removida com sucesso ");
        return redirect()->route('listar_series');
    }

    public function editaNome(int $id,Request $request)//dessa forma voce ganha uma segurança a mais definindo o tipo de dados que ter que vir na chamada
    {

        $novoNome = $request->nome;
        $serie = Serie::find($id);//Procura a serie
        $serie->nome = $novoNome; //Diz que o novo nome é o passado pela requisição
        $serie->save(); //O proprio nome ja diz salva a serie
    }
}
