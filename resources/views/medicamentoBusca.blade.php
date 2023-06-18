@extends('template')

@section('conteudo')
    <h1>Resultados da Busca</h1>

    @if ($medicamentos->isEmpty())
        <p>Nenhum medicamento encontrado.</p>
    @else
        <div class="row">
            @foreach($medicamentos as $medicamento)
                <div class="col-md-3">
                    <div class="card mb-4 medicamento-card">
                        <div class="medicamento-nome">{{$medicamento->nome}}</div>
                        <a href="{{ route('medicamento.detalhes', ['id' => $medicamento->id]) }}">
                            <img class="card-img-top medicamento-imagem medicamento-imagem-hover" src="/storage/imagens/{{$medicamento->imagem}}" alt="Imagem do Medicamento">
                        </a>
                        <div class="card-body">
                            <div class="medicamento-info">
                                <div class="medicamento-valor">Valor: <br><strong>R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</strong></div>
                                <div class="medicamento-quantidade">Quantidade: <br><strong> {{$medicamento->quantidade}}</strong></div>
                            </div>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Laboratório: {{$medicamento->laboratorios->nome}}</li>
                                <li class="list-group-item">Lote: {{$medicamento->lote}}</li>
                                <li class="list-group-item">Data de Validade: {{date('d/m/Y', strtotime($medicamento->data_validade))}}</li>
                                <li class="list-group-item">Data de Fabricação: {{date('d/m/Y', strtotime($medicamento->data_fabricacao))}}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{ $medicamentos->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
@endsection
