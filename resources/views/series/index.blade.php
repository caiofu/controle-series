@extends('layout')
@section('cabecalho')
Séries
@endsection

@section('conteudo')
    @include('mensagem', ['mensagem' => $mensagem])
@auth()
<a href="{{route('form_criar_serie')}}" class="btn btn-dark mb-2">Adicionar</a>
@endauth
<ul class="list-group">
    @foreach($series as $serie)
        <li class='list-group-item d-flex justify-content-between align-items-center' >
            <span id="nome-serie-{{ $serie->id }}">{{ $serie->nome }}</span>

            <div class="input-group w-50" hidden id="input-nome-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->nome }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="editarSerie({{ $serie->id }})">
                        <i class="fas fa-check"></i>
                    </button>
                    @csrf
                </div>
            </div>
            <span class="d-flex">
                @auth()
                <button class="btn btn-info btn-sm me-1" onclick="ativarInput({{$serie->id}})">
                    <i class="fas fa-edit"></i>
                </button>
                @endauth
                <a href="/series/{{$serie->id}}/temporadas" class="btn btn-info btn-sm me-1">
                    <i class="fas fa-external-link-alt"></i>
                </a>
                    @auth()
                    <form  method="post" action="/series/{{$serie->id}}" onsubmit="return confirm('Tem certeza que deseja remover {{addslashes($serie->nome)}}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </form>
                    @endauth
            </span>
        </li>
    @endforeach
</ul>
    <script>
        function ativarInput(serieId)
        {
            const nomeSerieElemento = document.getElementById('nome-serie-'+serieId);
            const inputSerieElemento = document.getElementById('input-nome-serie-'+serieId);
            if( nomeSerieElemento.hasAttribute('hidden'))
            {
                nomeSerieElemento.removeAttribute('hidden');
                inputSerieElemento.hidden = true;
            }
            else {
                inputSerieElemento.removeAttribute('hidden')
                nomeSerieElemento.hidden = true;
            }
        }

        function editarSerie(serieId)
        {
            let formData = new FormData();
            const nome = document.querySelector('#input-nome-serie-'+serieId+'>input').value;
            const token = document.querySelector('input[name="_token"]').value

            formData.append("nome", nome);
            formData.append("_token", token);
            //Enviar para uma rota
            const url = `/series/${serieId}/editaNome`;
            //Requisição
            fetch(url,{
                body: formData,
                method: 'POST',
            }).then(() =>{
                ativarInput(serieId);
                document.getElementById(`nome-serie-${serieId}`).textContent = nome; //Atualiza o nome
            });
        }

    </script>
@endsection
