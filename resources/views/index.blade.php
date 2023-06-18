@extends('template')

@section('conteudo')
  @if ($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

  <h1>Consulte os medicamentos disponíveis</h1>

  <form action="{{ route('medicamento.busca') }}" method="GET" class="mb-3">
    <div class="input-group">
        <input type="text" name="termo" class="form-control" placeholder="Digite o nome do medicamento">
        <button type="submit" class="btn btn-primary">Buscar</button>
    </div>
  </form>

  <div class="row">
    @foreach($medicamentos as $medicamento)
      <div class="col-md-3">
        <div class="card mb-4 medicamento-card">
          <a href='detalhes/{{$medicamento->id}}' class="text-decoration-none">
            <div class="card-body d-flex flex-column align-items-center">
              <div class="medicamento-nome">{{$medicamento->nome}}</div>
              <img class="card-img-top medicamento-imagem medicamento-imagem-hover" src="/storage/imagens/{{$medicamento->imagem}}" alt="Imagem do Medicamento">
              <div class="medicamento-info">
                <div class="medicamento-valor">Valor: <strong>R$ {{ number_format($medicamento->valor, 2, ',', '.') }}</strong></div>
              </div>
              <ul class="list-group list-group-flush">
                <li class="list-group-item lab-label">Laboratório:</li>
                <li class="list-group-item lab-nome">{{$medicamento->laboratorios->nome}}</li>
              </ul>
            </div>
          </a>
          <div class="card-footer footer-white">
          </div>
        </div>
      </div>
    @endforeach
  </div>

  <div class="d-flex justify-content-between">
    {{ $medicamentos->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
  </div>
@endsection

<style>
  .text-decoration-none {
    text-decoration: none !important;
  }

  .medicamento-nome {
    text-decoration: none;
    color: #000;
    font-weight: bold;
    margin-bottom: 10px;
    text-align: center;
  }

  .lab-label {
    font-weight: bold;
    text-align: center;
    list-style: none;
  }

  .lab-nome {
    text-align: center;
    list-style: none;
  }
</style>
