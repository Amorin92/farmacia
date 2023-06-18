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
  <h1>Cadastro de Transportadoras</h1>

  <form action="{{url('transportadora/store')}}" method="post">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$transportadora->id}}">
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input class="form-control" type="text" name="nome" value="{{$transportadora->nome}}">
    </div>
    <div class="mb-3">
        <label for="cnpj" class="form-label">CNPJ</label>
        <input class="form-control" type="text" name="cnpj" value="{{$transportadora->cnpj}}">
      </div>
    <div class="mb-3">
      <label for="endereco" class="form-label">Endereço</label>
      <input class="form-control" type="text" name="endereco" value="{{$transportadora->endereco}}">
    </div>

    <div class="mb-3">
        <label for="tipo" class="form-label">Modo de Envio</label>
        <select class="form-select @error('tipos_id') is-invalid @enderror" name="tipos_id">
            @foreach($tipos as $tipo)
                <option value="{{ $tipo->id }}" {{ $tipo->id == old('tipo_id', $transportadora->tipo_id) ? 'selected' : '' }}>
                    {{ $tipo->nome }}
                </option>
            @endforeach
        </select>
        @error('tipo_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>


    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
    <a href="{{ url('transportadora/listar') }}" class="btn btn-primary">Voltar</a>
  </form>
@endsection
