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

  <h1>Cadastro de Laboratório</h1>

  <form action="{{url('laboratorio/store')}}" method="post">
    @csrf
    <div class="mb-3">
      <label for="id" class="form-label">ID</label>
      <input readonly class="form-control" readonly type="text" name="id" value="{{$laboratorio->id}}">
    </div>
    <div class="mb-3">
      <label for="nome" class="form-label">Nome</label>
      <input class="form-control" type="text" name="nome" value="{{$laboratorio->nome}}">
    </div>
    <div class="mb-3">
      <label for="endereco" class="form-label">Endereço</label>
      <input class="form-control" type="text" name="endereco" value="{{$laboratorio->endereco}}">
    </div>


    <button class="btn btn-primary" type="submit" name="button">Salvar</button>
    <a href="{{ url('laboratorio/listar') }}" class="btn btn-primary">Voltar</a>

  </form>
@endsection
