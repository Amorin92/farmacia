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

  <h1 class="text-center">Cadastro de Medicamentos</h1>

  <div class="container">
    <div class="row">
      <div class="col-md-4">
        @if ($medicamento->imagem != "")
          <img id="imagem-preview" class="card-img-top medicamento-imagem" src="/storage/imagens/{{$medicamento->imagem}}" alt="Imagem do Medicamento">
        @endif
      </div>
      <div class="col-md-4">
        <form action="{{url('medicamento/store')}}" method="post" enctype="multipart/form-data" class="shadow p-4">
          @csrf
          <div class="mb-3">
            <label for="id" class="form-label">ID</label>
            <input readonly class="form-control" readonly type="text" name="id" value="{{$medicamento->id}}">
          </div>
          <!-- Parte simétrica do formulário -->
          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input class="form-control @error('nome') is-invalid @enderror" type="text" name="nome" value="{{old('nome', $medicamento->nome)}}">
            @error('nome')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="lote" class="form-label">Lote</label>
            <input class="form-control @error('lote') is-invalid @enderror" type="text" name="lote" value="{{old('lote', $medicamento->lote)}}">
            @error('descricao')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <!-- Restante do formulário -->
          <div class="mb-3">
            <label for="laboratorio" class="form-label">Laboratório</label>
            <select class="form-select @error('laboratorio_id') is-invalid @enderror" name="laboratorio_id">
              @foreach($laboratorios as $laboratorio)
                <option {{ $laboratorio->id == old('laboratorio_id', $medicamento->laboratorio_id) ?'selected': ''}} value="{{$laboratorio->id}} ">{{$laboratorio->nome}}</option>
              @endforeach
            </select>
            @error('laboratorio_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="data_validade" class="form-label">Data de validade</label>
            <input class="form-control @error('data_validade') is-invalid @enderror" type="date" name="data_validade" value="{{old('data_validade', date('Y-m-d', strtotime($medicamento->data_validade)))}}">
            @error('data_validade')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

      </div>
      <div class="col-md-4">
        <div class="shadow p-4">
          <div class="mb-3">
            <label for="data_fabricacao" class="form-label">Data de Fabricação</label>
            <input class="form-control @error('data_fabricacao') is-invalid @enderror" type="date" name="data_fabricacao" value="{{old('data_fabricacao', date('Y-m-d', strtotime($medicamento->data_fabricacao)))}}">
            @error('data_fabricacao')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="transportadoras" class="form-label">Transportadora</label>
            <select class="form-select @error('transportadoras_id') is-invalid @enderror" name="transportadoras_id">
              @foreach($transportadoras as $transportadora)
                <option {{ $transportadora->id == old('transportadoras_id', $medicamento->transportadora_id) ?'selected': ''}} value="{{$transportadora->id}} ">{{$transportadora->nome}}</option>
              @endforeach
            </select>
            @error('transportadoras_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="mb-3">
            <label for="valor" class="form-label">Valor</label>
            <input class="form-control" type="text" name="valor" value="{{$medicamento->valor}}">
          </div>
          @if ($medicamento->id != 0)
            <div class="mb-3">
              <label for="quantidade" class="form-label">Quantidade</label>
              <input readonly class="form-control" type="text" name="quantidade" value="{{$medicamento->quantidade}}">
            </div>
          @else
            <div class="mb-3">
              <label for="quantidade" class="form-label">Quantidade</label>
              <input class="form-control" type="text" name="quantidade" value="{{$medicamento->quantidade}}">
            </div>
          @endif
          <div class="mb-3">
            <label for="arquivo" class="form-label">Imagem</label>
            <input id="imagem-input" class="form-control" type="file" name="arquivo" accept="image/*">
          </div>
        </div>

        <div class="d-flex justify-content-between mt-2">
            <button class="btn btn-primary animated infinite pulse btn-glow" type="submit" name="button">Salvar</button>
            <a href="{{ url('medicamento/listar') }}" class="btn btn-primary">Voltar</a>
          </div>
          
      </div>
    </div>
  </div>
</form>

@endsection
