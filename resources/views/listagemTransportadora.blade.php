@extends('template')

@section('conteudo')
  <h1>Listagem de Transportadoras</h1>
  @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
  @endif
  <a href="novo" class="btn btn-primary">Novo</a>
  <table class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CNPJ</th>
        <th>Endereço</th>
        <th>Modo de Envio</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($transportadoras as $transportadora)
          <tr>
            <td>{{$transportadora->id}}</td>
            <td>{{$transportadora->nome}}</td>
            <td>{{$transportadora->cnpj}}</td>
            <td>{{$transportadora->endereco}}</td>
            <td>{{$transportadora->tipos ? $transportadora->tipos->nome : '-'}}</td>
            <td><a class='btn btn-primary' href='edit/{{$transportadora->id}}'>Editar</a></td>
            {{-- <td><a class='btn btn-danger' href='destroy/{{$transportadora->id}}'>Deletar</a></td> --}}
            <td>
                <form action="destroy/{{$transportadora->id}}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza de que deseja deletar este item?')">Deletar</button>
                </form>
              </td>
          </tr>
      @endforeach

   </tbody>
  </table>
  {{ $transportadoras->onEachSide(1)->links('pagination::bootstrap-4')->withClass('pagination-sm') }}
@endsection
